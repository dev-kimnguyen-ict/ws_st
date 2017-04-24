<script type="text/javascript">
    (function($)
    {
        $(document).ready(function()
        {
            var main = $('#main_product');

            // Tips
            main.find('.tipN').tipsy({gravity:'n', fade:false, html:true});
            main.find('.tipS').tipsy({gravity:'s', fade:false, html:true});
            main.find('.tipW').tipsy({gravity:'w', fade:false, html:true});
            main.find('.tipE').tipsy({gravity:'e', fade:false, html:true});
            
            // Tooltip
            main.find('[_tooltip]').nstUI({
                method: 'tooltip'
            });
        });
    })(jQuery);
</script>

<script type="text/javascript">
    (function($)
    {
        $(document).ready(function()
        {
            var main = $('#form');
            
            // Tabs
            main.contentTabs();
        });
    })(jQuery);
</script>