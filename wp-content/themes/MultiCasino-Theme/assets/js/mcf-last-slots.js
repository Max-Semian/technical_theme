jQuery(document).ready(function ($) {
  const blockId = "#last-slots-block-1";
  let currentPage = 1;
  let isLoading = false;

  function loadLastSlots(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .slots-items`);
    const readMoreBtn = $(`${blockId} #last-slots-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfLastSlotsData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfLastSlotsData.loading_text);
    }

    $.post(
      mcfLastSlotsData.ajax_url,
      {
        action: "mcf_filter_last_slots",
        page: page,
        block_id: "last-slots-block-1",
        all_tag_ids: lastSlotsTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No slots found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfLastSlotsData.no_more_text);
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
    loadLastSlots(currentPage);
  }

  $(`${blockId} #last-slots-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadLastSlots(currentPage, true);
  });
});
