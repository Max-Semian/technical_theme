jQuery(document).ready(function ($) {
  let currentTagId = $("#linksFilters li.active").data("tag-id");
  let currentPage = 1;
  let isLoading = false;

  function loadBonuses(tagId, page, append = false) {
    if (isLoading) return;
    isLoading = true;

    if (!append) {
      $("#bonusesItems").html("<p>" + mcfBonusesData.loading_text + "</p>");
    } else {
      $("#js-ajax-bonuses-template").text(mcfBonusesData.loading_text);
    }

    $.post(
      mcfBonusesData.ajax_url,
      {
        action: "mcf_filter_bonuses",
        tag_id: tagId,
        page: page,
      },
      function (response) {
        if (!append) {
          $("#bonusesItems").html(response);
        } else {
          $("#bonusesItems").append(response);
          $("#js-ajax-bonuses-template").text("Other casinos");
        }
        isLoading = false;
      }
    );
  }

  // Загрузка при старте
  if (currentTagId) {
    loadBonuses(currentTagId, currentPage);
  }

  // Клик по фильтру
  $("#linksFilters li").on("click", function (e) {
    e.preventDefault();
    if ($(this).hasClass("active")) return;

    $("#linksFilters li").removeClass("active");
    $(this).addClass("active");

    currentTagId = $(this).data("tag-id");
    currentPage = 1;
    loadBonuses(currentTagId, currentPage);
  });

  // Клик по кнопке загрузки
  $("#js-ajax-bonuses-template").on("click", function (e) {
    e.preventDefault();
    currentPage++;
    loadBonuses(currentTagId, currentPage, true);
  });
});
