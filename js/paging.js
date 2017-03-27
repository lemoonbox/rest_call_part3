var write_table = function(data, tablename){
    var $tabletag = $(tablename);
    var sortable = data.results;
    //descending order by id
    sortable.sort(function(a, b) {
        return b.id - a.id;
    })

    //write data table
    for (var index in sortable) {
        var $tr_tag = $('<tr class="pr_line"' + index + '></div>');
        for (var field_name in sortable[index]) {
            var $td_tag = $("<td class=" + field_name + ">" + sortable[index][field_name] + "</td>");
            $td_tag.appendTo($tr_tag)
        }
        $tr_tag.appendTo($tabletag);
    }
};


var mobli_paging = function(offset=0) {
    //remove paging
    var $paging_block = $("#pagination");
    var $page_lines = $("#pagination li");
    $page_lines.remove();
    var actoin_url ="/product_ajax.php?offset=" + offset;
    
    var sc_fc = function(data) {
        write_table(data, "#prd_table");
        //write pagination
        var $paging_block = $("#pagination");
        var $get_more = $("<li><a class='paging' data-offset="+data['url_next1']+">다음 페이지 더 보기</li>");
        $get_more.appendTo($paging_block);

        $('a.paging').click(function() {
            var data_offset = $(this).data('offset');
            mobli_paging(data_offset);
        });
    }
    ajax_call('get', actoin_url, {'dataType' : 'none'}, sc_fc);

};
