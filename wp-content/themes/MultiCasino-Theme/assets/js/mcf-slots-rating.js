jQuery(document).ready(function ($) {
  const blockId = "#slots-block-2";
  let currentPage = 1;
  let isLoading = false;

  function loadSlots(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .slots-items`);
    const readMoreBtn = $(`${blockId} #slots-block-2-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfSlotsRatingData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfSlotsRatingData.loading_text);
    }

    $.post(
      mcfSlotsRatingData.ajax_url,
      {
        action: "mcf_filter_slots_rating",
        page: page,
        block_id: "slots-block-2",
        all_tag_ids: slotsTagIdsBlock2,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No slots found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfSlotsRatingData.no_more_text);
          }
        }

        if (itemsContainer.find(".slot").length < 15 * currentPage) {
          readMoreBtn.hide();
        } else {
          readMoreBtn.show();
        }

        isLoading = false;
      }
    );
  }

  if ($(blockId).length) {
    loadSlots(currentPage);
  }

  $(`${blockId} #slots-block-2-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadSlots(currentPage, true);
  });
});
