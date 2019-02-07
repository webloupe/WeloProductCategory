// {block name="backend/category/controller/article_mapping"}
// {$smarty.block.parent}
Ext.define('Shopware.apps.WeloProductCategory.controller.ArticleMapping', {
    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    override: 'Shopware.apps.Category.controller.ArticleMapping',

    /**
     * Initiate
     */
    init: function () {

        var me = this;

        me.control({
            'category-category-tabs-article_mapping': {
                'search': me.onSearch,
                'add': me.onAddProducts,
                'remove': me.onRemoveProducts,
                openArticle: me.onOpenArticle,
            },
            'category-category-tabs-article_mapping grid': {
                'selectionchange': me.onSelectionChange
            },
            'category-category-tabs-article_mapping gridview': {
                'drop': me.onDragAndDropAssignment
            }
        });
    },

    /**
     * Event listener method which is fired when the user clicks the
     * action column icon to open the article detail page of the order position article.
     *
     * @param [Ext.data.Model] record - The row record
     */
    onOpenArticle: function(record) {
        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.Article',
            action: 'detail',
            params: {
                articleId: record.get('articleId')
            }
        });
    }
});
//{/block}
