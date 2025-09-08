jQuery(document).ready(function ($) {
  const blockId = "#multicasino-block-1";
  let currentPage = 1;
  let isLoading = false;

  function loadMulticasino(page, append = false) {
    if (isLoading) return;
    isLoading = true;

    const itemsContainer = $(`${blockId} .best-casinos-items`);
    const readMoreBtn = $(`${blockId} #multicasino-block-1-read-more`);

    if (!append) {
      itemsContainer.html("<p>" + mcfMulticasinoData.loading_text + "</p>");
    } else {
      readMoreBtn.text(mcfMulticasinoData.loading_text);
    }

    $.post(
      mcfMulticasinoData.ajax_url,
      {
        action: "mcf_filter_multicasino",
        page: page,
        block_id: "multicasino-block-1",
        all_tag_ids: multicasinoTagIds,
      },
      function (response) {
        if (!append) {
          itemsContainer.html(response);
        } else {
          if ($.trim(response).indexOf("No casinos found") !== -1) {
            readMoreBtn.hide();
          } else {
            itemsContainer.append(response);
            readMoreBtn.text(mcfMulticasinoData.no_more_text);
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
    loadMulticasino(currentPage);
  }

  $(`${blockId} #multicasino-block-1-read-more`).on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadMulticasino(currentPage, true);
  });
});
