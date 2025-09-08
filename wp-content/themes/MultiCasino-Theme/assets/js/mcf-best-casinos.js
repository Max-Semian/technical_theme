jQuery(document).ready(function ($) {
  const blockId = "#best-casinos-block-1";
  let currentPage = 1;
  let isLoading = false;

  function loadBestCasinos(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .best-casinos-items`);
    const readMoreBtn = $(`${blockId} #best-casinos-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfBestCasinosData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfBestCasinosData.loading_text);
    }

    $.post(
      mcfBestCasinosData.ajax_url,
      {
        action: "mcf_filter_best_casinos",
        page: page,
        block_id: "best-casinos-block-1",
        all_tag_ids: bestCasinosTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No casinos found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfBestCasinosData.no_more_text);
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
    loadBestCasinos(currentPage);
  }

  $(`${blockId} #best-casinos-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadBestCasinos(currentPage, true);
  });
});
