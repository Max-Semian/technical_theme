// Проверка на существование элемента на странице
if (jQuery("#bonuses-block-1").length) {
    jQuery(document).ready(function ($) {
      let currentPage = 2;
      const button = $("#load-more-btn-block-1");
      const container = $("#bonuses-block-1");
      const postsPerPage = bonusBlock1Data.posts_per_page;
      const tagIds = bonusBlock1Data.tag_ids; // это уже строка типа "28,29"
    
      button.on("click", function (e) {
        e.preventDefault();
    
        $.ajax({
          url: bonusBlock1Data.ajax_url,
          type: "POST",
          data: {
            action: "load_more_bonus_block_1",
            tag_ids: tagIds, // строка, не массив!
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
}