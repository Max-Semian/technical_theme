const setRating = (stars: NodeListOf<Element>, rating: number) => {
	const commentForm = document.querySelector<HTMLFormElement>("#comment_form");
	const ratingInput = commentForm?.querySelector<HTMLInputElement>("#rating");

	const classActive = "active";

	let currentRating = rating;

	if (currentRating < 1) {
		// is clear
		for (let i = currentRating; i < stars.length; ++i) {
			const star = stars[i].querySelector(".star");

			if (star) {
				star.className = "star mb-2";
			}
		}

		return;
	}

	if (currentRating > 5) {
		currentRating = 5;
	}

	if (ratingInput) {
		ratingInput.value = String(currentRating);
	}

	// set active stars before currentRating
	for (let i = 0; i < currentRating; i++) {
		const star = stars[i].querySelector(".star");

		if (!star?.classList.contains(classActive)) {
			star.classList.add(classActive);
		}
	}

	// set inactive stars after currentRating
	for (let i = currentRating; i < stars.length; i++) {
		const star = stars[i].querySelector(".star");

		if (star?.classList.contains(classActive)) {
			star.classList.remove(classActive);
		}
	}
};

const executeRating = () => {
	const stars = document.querySelectorAll<HTMLDivElement>(".comment-star");

	let currentRating;

	stars.forEach((star, index) => {
		star.addEventListener("click", () => {
			currentRating = index + 1;

			setRating(stars, currentRating);
		});
	});
};

executeRating();

// jQuery
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
jQuery(document).ready(function ($) {
	"use strict";

	const commentForm = $("#comment_form"),
		checkboxField = $("#is-get-auth-data"),
		authorFieldWrapper = $(".comment-form-author"),
		emailFieldWrapper = $(".comment-form-email"),
		ratingStars = $(".comment-star"),
		commentListSelector = ".comment-list",
		loadButtonSelector = "#load-comments",
		allPageAttrName = "data-comment-all-count",
		currentPageAttrName = "data-comment-current-count";

	const changeLoadButtonState = (buttonEl: { toggleClass: (arg0: string) => void }) => {
		if (!buttonEl) {
			return;
		}

		buttonEl.toggleClass("cursor-pointer");
		buttonEl.toggleClass("cursor-wait");
		buttonEl.toggleClass("opacity-75");
	};

	if (checkboxField) {
		checkboxField.change(function () {
			if (this.checked) {
				authorFieldWrapper.hide();
				emailFieldWrapper.hide();

				authorFieldWrapper.find("input").attr("required", false);
				emailFieldWrapper.find("input").attr("required", false);
			} else {
				authorFieldWrapper.show();
				emailFieldWrapper.show();

				authorFieldWrapper.find("input").attr("required", true);
				emailFieldWrapper.find("input").attr("required", true);
			}
		});
	}

	commentForm.submit(function (e: { preventDefault: () => void }) {
		e.preventDefault();

		const button = $(this).find("#submit"),
			commentField = $(this).find("#comment-form-textarea"),
			authorField = $(this).find("#comment-form-author"),
			emailField = $(this).find("#comment-form-email"),
			cancelReplyLink = $("#cancel-comment-reply-link"),
			respond = $("#respond"),
			loadButton = $(loadButtonSelector);

		$.ajax({
			type: "POST",
			// eslint-disable-next-line @typescript-eslint/ban-ts-comment
			// @ts-ignore
			url: ajax_data?.ajax_url,
			data: commentForm.serialize() + "&action=sendcomment",
			beforeSend() {
				button?.toggleClass("cursor-pointer");
				button?.toggleClass("cursor-wait");
				button?.attr("disabled", "disabled");

				changeLoadButtonState(loadButton);
			},
			error(request: { responseText: string }, status: string | number) {
				if (status == 500) {
					alert("Error while adding comment");
				} else if (status == "timeout") {
					alert("Error: Server doesn't respond.");
				} else {
					// process WordPress errors
					const wpErrorHtml = request.responseText.split("<p>"),
						wpErrorStr = wpErrorHtml[1].split("</p>");

					alert(wpErrorStr[0]);
				}
			},
			success(response: string) {
				const commentList = $(commentListSelector);

				// if this post already has comments
				if (commentList.length) {
					// if in reply to another comment
					if (respond?.parent().hasClass("comment")) {
						// if the other replies exist
						if (respond.parent().children(".children").length) {
							respond.parent().children(".children").append(response);
						} else {
							// if no replies, add <ul class="children">
							respond.after('<ul class="children">' + response + "</ul>");
						}

						// close respond form
						cancelReplyLink.trigger("click");
					} else {
						// simple comment
						commentList.prepend(response);
					}
				} else {
					// if no comments yet
					const commentsWrapper = $(".comments-wrapper");
					commentsWrapper?.append(
						`<div class="mb-6">
							<ul class="comment-list">
								${response}
							</ul>
					 	</div>`
					);
				}

				if (loadButton) {
					const newAllCount = Number(loadButton.attr(allPageAttrName) || 0) + 1;
					const newCurrentCount = commentList.children().length;

					loadButton.attr(allPageAttrName, newAllCount);
					loadButton.attr(currentPageAttrName, newCurrentCount);
				}

				cancelReplyLink.trigger("click");

				// clear fields
				commentField.val("");
				authorField.val("");
				emailField.val("");
				checkboxField.prop("checked", false);
				authorFieldWrapper.show();
				emailFieldWrapper.show();

				setRating?.(ratingStars, 0);
			},
			complete() {
				button?.toggleClass("cursor-pointer");
				button?.toggleClass("cursor-wait");
				button?.prop("disabled", false);

				const emptyCommentEl = $(".empty-comments");

				if (emptyCommentEl) {
					emptyCommentEl.toggleClass("hidden");
				}

				changeLoadButtonState(loadButton);
			},
		});

		return false;
	});

	const loadButton = $(loadButtonSelector);
	const commentList = $(commentListSelector);

	loadButton?.on("click", function () {
		const postId = $(this).attr("data-post-id");
		const perPage = $(this).attr("data-comment-per-page") || 5;
		const allCount = $(this).attr("data-comment-all-count") || 0;
		const currentCount = $(this).attr(currentPageAttrName) || commentList.children().length;

		if (!postId) {
			return;
		}

		$.ajax({
			// eslint-disable-next-line @typescript-eslint/ban-ts-comment
			// @ts-ignore
			url: ajax_data.ajax_url,
			type: "post",
			data: {
				action: "load_comments",
				"post-id": postId,
				"per-page": perPage,
				"current-count": currentCount,
			},
			beforeSend() {
				changeLoadButtonState(loadButton);
			},
			success(response: string) {
				if (response) {
					commentList.append(response);
				}
			},
			complete() {
				const currentCommentCount = commentList.children().length;

				if (currentCommentCount < allCount) {
					loadButton.attr(currentPageAttrName, currentCommentCount);
					loadButton.text(
						`Show ${Math.min(allCount - currentCommentCount, perPage)} more feedbacks`
					);
				} else {
					loadButton.parent().toggleClass("hidden");
				}

				changeLoadButtonState(loadButton);
			},
		});
	});
});
