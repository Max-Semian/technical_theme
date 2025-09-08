jQuery(document).ready(function ($) {
  const blockId = "#one-slots-block-1";
  let currentPage = 1;
  let isLoading = false;

  function loadOneSlots(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .slots-items`);
    const readMoreBtn = $(`${blockId} #one-slots-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfOneSlotsData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfOneSlotsData.loading_text);
    }

    $.post(
      mcfOneSlotsData.ajax_url,
      {
        action: "mcf_filter_one_slots",
        page: page,
        block_id: "one-slots-block-1",
        all_tag_ids: oneSlotsTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No slots found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfOneSlotsData.no_more_text);
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
    loadOneSlots(currentPage);
  }

  $(`${blockId} #one-slots-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadOneSlots(currentPage, true);
  });
});
