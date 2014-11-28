/**
 * Created with JetBrains PhpStorm.
 * User: schuma
 * Date: 27/11/14
 * Time: 22:33
 * To change this template use File | Settings | File Templates.
 */

function pagination(nbParPage,divSelect,divPager,model)
{
//Initialisation
    var nbElem = $(divSelect).length;
    var nbPage = Math.ceil(nbElem / nbParPage);
    var pageLoad = 1;
    $(divSelect).each(function(index) {
        if (index < nbParPage)
            $(divSelect).eq(index).show();
        else
            $(divSelect).eq(index).hide();
    });
//Reset & verification
    function reset() {
        if (nbPage < 2) $(divPager).hide();
        if (pageLoad == nbPage) $(divPager + ' span.suivant').hide(); else $(divPager + ' span.suivant').show();
        if (pageLoad == 1) $(divPager + ' span.precedent').hide(); else $(divPager + ' span.precedent').show();
        $(divPager + ' ul li').removeClass('active');
        $(divPager + ' ul li').eq(pageLoad -1).addClass('active');
    }
//Pagination generation
    if (model != 1) {
        $(divPager).html('<ul class="pagination"></ul>');
        for(i = 1; i <= nbPage; i++) $(divPager + ' ul').append('<li><span class="btn btn-info">' + i + '</span></li>');
//Changement click page
        $(divPager + ' ul li').click(function() {
            if ($(this).index() + 1 != pageLoad) {
                pageLoad = $(this).index() + 1;
                $(divSelect).hide();
                $(divSelect).each(function(i) {
                    if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
                });
                reset();
            }
        });
    }
//Suivant Precedent
    if (model == 1) {
        $(divPager).prepend('<span class="precedent">&laquo;</span>');
        $(divPager).append('<span class="suivant">&raquo;</span>');
    } else if (model == 3) {
        $(divPager + ' ul').before('<span class="precedent">&laquo;</span>');
        $(divPager + ' ul').after('<span class="suivant">&raquo;</span>');
    }
//Evenement click sur suivant
    $(divPager + ' span.suivant').click(function() {
        if (pageLoad < nbPage) {
            pageLoad += 1;
            $(divSelect).hide();
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            reset();
        }
    });
//Evenement click sur precedent
    $(divPager + ' span.precedent').click(function() {
        if (pageLoad -1 >= 1) {
            pageLoad -= 1;
            $(divSelect).hide();
            $(divSelect).each(function(i) {
                if (i >= ((pageLoad * nbParPage) - nbParPage) && i < (pageLoad * nbParPage)) $(this).show();
            });
            reset();
        }
    });
    reset();
}
