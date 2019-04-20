/**
 * Created by OMP on 08/03/2019.
 */

$('.side-menu').perfectScrollbar({
    wheelSpeed: 12,
    wheelPropagation: true,
    scrollYMarginOffset  : 5,
    useBothWheelAxes:false
});

// if the model has multilingual field(s) and the lang was farsi
// when farsi selected the element direction changed to right-to-left
$('.language-selector input[name="i18n_selector"]').on('change', function () {
    if($(this).attr('id') === 'fa')
    {
        $('input[id*="_i18n"] + textarea').attr('dir', 'rtl');
        $('input[id*="_i18n"] + input').attr('dir', 'rtl');
        $('input[id*="_i18n"] + div').attr('dir', 'rtl');
        $('input[id*="_i18n"] + p').attr('dir', 'rtl');
    }
    else
    {
        $('input[id*="_i18n"] + textarea').after().attr('dir', 'ltr');
        $('input[id*="_i18n"] + input').after().attr('dir', 'ltr');
        $('input[id*="_i18n"] + div').after().attr('dir', 'ltr');
        $('input[id*="_i18n"] + p').after().attr('dir', 'ltr');
    }
});