// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
jQuery(document).ready(function ($) {
	"use strict";

	// Upload Taxonomy Image Start

	function custom_image_upload(button_class: string) {
		"use strict";

		let customMedia = true;
		// eslint-disable-next-line @typescript-eslint/ban-ts-comment
		// @ts-ignore
		const origSendAttachment = wp.media.editor.send.attachment;

		$("body").on("click", button_class, function () {
			"use strict";
			const buttonId = "#" + $(this).attr("id");
			const button = $(buttonId);
			customMedia = true;

			// eslint-disable-next-line @typescript-eslint/ban-ts-comment
			// @ts-ignore
			wp.media.editor.send.attachment = function (props, attachment) {
				"use strict";

				if (customMedia) {
					$("#taxonomy-image-id").val(attachment.id);
					$("#taxonomy-image-wrapper").html(
						'<img class="custom_media_image" src="" style="margin: 0; padding: 0; max-height: 32px; float: none;" />'
					);
					$("#taxonomy-image-wrapper .custom_media_image")
						.attr("src", attachment.url)
						.css("display", "block");
				} else {
					return origSendAttachment.apply(buttonId, [props, attachment]);
				}
			};

			// eslint-disable-next-line @typescript-eslint/ban-ts-comment
			// @ts-ignore
			wp.media.editor.open(button);

			return false;
		});
	}

	custom_image_upload(".custom_media_button.button");

	$("body").on("click", ".custom_media_remove", function () {
		"use strict";
		$("#taxonomy-image-id").val("");
		$("#taxonomy-image-wrapper").html(
			'<img class="custom_media_image" src="" style="margin: 0; padding: 0; max-height: 32px; float: none;" />'
		);
	});

	// eslint-disable-next-line @typescript-eslint/ban-ts-comment
	// @ts-ignore
	$(document).ajaxComplete(function (event, xhr, settings) {
		"use strict";

		let response;
		const queryStringArr = settings.data.split("&");

		if ($.inArray("action=add-tag", queryStringArr) !== -1) {
			const xml = xhr.responseXML;
			response = $(xml).find("term_id").text();

			if (response != "") {
				$("#taxonomy-image-wrapper").html("");
			}
		}
	});

	// Upload Taxonomy Image End

	// Upload image - Start
	$("body").on("click", ".custom_upload_button", function (e: { preventDefault: () => void }) {
		"use strict";

		e.preventDefault();

		const button = $(this);

		// eslint-disable-next-line @typescript-eslint/ban-ts-comment
		// @ts-ignore
		const customUploader = wp
			.media({
				title: "Insert image",
				library: {
					type: "image",
				},
				button: {
					text: "Set image",
				},
				multiple: false,
			})
			.on("select", function () {
				"use strict";

				const attachment = customUploader.state().get("selection").first().toJSON();

				$(button)
					.removeClass("button")
					.html(
						'<img class="custom-admin-image" src="' +
							attachment.url +
							'" style="max-width: 100%; width: auto; display:block;" />'
					)
					.next()
					.val(attachment.id)
					.next()
					.show();
			})
			.open();
	});

	$("body").on("click", ".custom_remove_button", function () {
		"use strict";

		$(this).hide().prev().val("").prev().addClass("button").html("Upload image");

		return false;
	});

	// Upload image - End
});
