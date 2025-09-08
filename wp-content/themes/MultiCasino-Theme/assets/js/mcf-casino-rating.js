jQuery(document).ready(function ($) {
  const blockId = "#casinos-block-2";
  let currentTagId = 0;
  let currentPage = 1;
  let isLoading = false;

  function loadCasinos(tagId, page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .best-casinos-items`);
    const readMoreBtn = $(`${blockId} #casinos-block-2-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfCasinoRatingData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfCasinoRatingData.loading_text);
    }

    $.post(
      mcfCasinoRatingData.ajax_url,
      {
        action: "mcf_filter_casino_rating",
        tag_id: tagId,
        page: page,
        block_id: "casinos-block-2",
        all_tag_ids: casinosTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No casinos found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfCasinoRatingData.no_more_text);
          }
        }

        if (itemsContainer.find(".row").length < 14 * currentPage) {
          readMoreBtn.hide();
        } else {
          readMoreBtn.show();
        }

        isLoading = false;
      }
    );
  }

  if ($(blockId).length) {
    loadCasinos(currentTagId, currentPage);
  }

  $(`${blockId} .links-filters li`).on("click", function (e) {
    e.preventDefault();
    $(`${blockId} .links-filters li`).removeClass("active");
    $(this).addClass("active");

    currentTagId = $(this).data("tag-id");
    currentPage = 1;
    $(`${blockId} #casinos-block-2-read-more`)
      .show()
      .text(mcfCasinoRatingData.no_more_text);

    loadCasinos(currentTagId, currentPage);
  });

  $(`${blockId} #casinos-block-2-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadCasinos(currentTagId, currentPage, true);
  });
});
