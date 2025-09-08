jQuery(document).ready(function ($) {
  const blockId = "#casinos-block-1";
  let currentTagId = 0;
  let currentPage = 1;
  let isLoading = false;
  let currentQuery = "";

  function loadCasinos(tagId, page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .best-casinos-items`);
    const readMoreBtn = $(`${blockId} #casinos-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfCasinosData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfCasinosData.loading_text);
    }

    $.post(
      mcfCasinosData.ajax_url,
      {
        action: "mcf_filter_casinos",
        tag_id: tagId,
        page: page,
        block_id: "casinos-block-1",
        all_tag_ids: bonusTagIds,
        search_query: currentQuery,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No casinos found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfCasinosData.no_more_text);
          }
        }

        if (itemsContainer.find(".row").length < 9 * currentPage) {
          readMoreBtn.hide();
        } else {
          readMoreBtn.show();
        }

        isLoading = false;
      }
    );
  }

  const activeFilterName = $(
    `${blockId} .filter-item-variants li[data-tag-id="${currentTagId}"] a`
  ).text();
  if (activeFilterName) {
    $(`#filterChose`).text(activeFilterName);
  }

  if ($(blockId).length) {
    loadCasinos(currentTagId, currentPage);
  }

  $(`${blockId} .filter-item-variants li`).on("click", function (e) {
    e.preventDefault();
    $(`${blockId} .filter-item-variants li`).removeClass("active");
    $(this).addClass("active");

    const name = $(this).find("a").text();
    $(`#filterChose`).text(name);

    currentTagId = $(this).data("tag-id");
    currentPage = 1;
    $(`${blockId} #casinos-block-1-read-more`)
      .show()
      .text(mcfCasinosData.no_more_text);

    loadCasinos(currentTagId, currentPage);
  });

  $(`${blockId} #casinos-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadCasinos(currentTagId, currentPage, true);
  });

  // 🔍 ПОИСК ОТ 3 СИМВОЛОВ
  let searchTimeout;
  $(`${blockId} input[name="query"]`).on("input", function () {
    const query = $(this).val().trim();

    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(function () {
      if (query.length >= 3 || query.length === 0) {
        // 👈 проверка длины или очистка
        currentQuery = query;
        currentPage = 1;
        loadCasinos(currentTagId, currentPage);
      }
    }, 300); // 👈 debounce 300ms для плавности
  });
});
