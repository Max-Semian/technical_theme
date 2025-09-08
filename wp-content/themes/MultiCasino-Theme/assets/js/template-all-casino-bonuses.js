jQuery(document).ready(function ($) {
  if (typeof bonusBlock3Data === "undefined") {
    return; // КОММЕНТАРИЙ: если данных нет — просто не выполняем скрипт
  }

  let currentPage = 2;
  const button = $("#load-more-btn-block-3");
  const container = $("#bonuses-block-3");
  const postsPerPage = bonusBlock3Data.posts_per_page;
  const tagIds = bonusBlock3Data.tag_ids;

  button.on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: bonusBlock3Data.ajax_url,
      type: "POST",
      data: {
        action: "load_more_bonus_block_3",
        tag_ids: tagIds,
        page: currentPage,
        posts_per_page: postsPerPage,
      },
      success: function (response) {
        if ($.trim(response) !== "") {
          container.append(response);
          currentPage++;
        } else {
          button.hide();
        }
      },
    });
  });
});
