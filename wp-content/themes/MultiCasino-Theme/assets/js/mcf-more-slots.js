jQuery(document).ready(function ($) {
  const blockId = "#more-slots-block-1";
  let currentPage = 1;
  let isLoading = false;

  function loadMoreSlots(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .slots-items`);
    const readMoreBtn = $(`${blockId} #more-slots-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfMoreSlotsData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfMoreSlotsData.loading_text);
    }

    $.post(
      mcfMoreSlotsData.ajax_url,
      {
        action: "mcf_filter_more_slots",
        page: page,
        block_id: "more-slots-block-1",
        all_tag_ids: moreSlotsTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No slots found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfMoreSlotsData.no_more_text);
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
    loadMoreSlots(currentPage);
  }

  $(`${blockId} #more-slots-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadMoreSlots(currentPage, true);
  });
});
