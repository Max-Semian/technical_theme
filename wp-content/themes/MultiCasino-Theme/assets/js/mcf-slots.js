jQuery(document).ready(function ($) {
  const blockId = "#slots-block-1";
  let currentTagId = 0; // ✅ Начинаем всегда с ALL

  let currentPage = 1;
  let isLoading = false;
  let currentQuery = "";

  function loadSlots(tagId, page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .slots-items`);
    const readMoreBtn = $(`${blockId}-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfSlotsData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfSlotsData.loading_text);
    }

    $.post(
      mcfSlotsData.ajax_url,
      {
        action: "mcf_filter_slots",
        tag_id: tagId,
        page: page,
        block_id: "slots-block-1",
        all_tag_ids: slotsTagIds, // ✅ исправлено
        search_query: currentQuery,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No slots found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfSlotsData.no_more_text);
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
    loadSlots(currentTagId, currentPage);
  }

  $(`${blockId} .filter-item-variants li`).on("click", function (e) {
    e.preventDefault();
    $(`${blockId} .filter-item-variants li`).removeClass("active");
    $(this).addClass("active");

    const name = $(this).find("a").text();
    $(`#filterChose`).text(name);

    currentTagId = $(this).data("tag-id");
    currentPage = 1;
    $(`${blockId}-read-more`).show().text(mcfSlotsData.no_more_text);

    loadSlots(currentTagId, currentPage);
  });

  $(`${blockId}-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadSlots(currentTagId, currentPage, true);
  });

  let searchTimeout;
  $(`${blockId} input[name="query"]`).on("input", function () {
    const query = $(this).val().trim();
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function () {
      if (query.length >= 3 || query.length === 0) {
        currentQuery = query;
        currentPage = 1;
        loadSlots(currentTagId, currentPage);
      }
    }, 300);
  });
});
