//{block name="backend/category/view/tabs/article_mapping"}
//{$smarty.block.parent}
Ext.define('Shopware.apps.WeloProductCategory.view.tabs.ArticleMapping', {
    override: 'Shopware.apps.Category.view.category.tabs.ArticleMapping',

    /**
     * Return an array of objects (grid columns)
     *
     * @return array of grid columns
     */
    getColumns: function () {
        var me = this;
        var columns = me.callParent(arguments);

        columns.splice(4, 0,
            {
                xtype:"actioncolumn",
                align:"center",
                width:25,
                items:[
                    {
                        iconCls:'sprite-inbox',
                        action:'openArticle',
                        tooltip: '{s name="open_article" namespace="backend/plugins/WeloProductCategory/main"}{/s}',
                        handler:function (view, rowIndex, colIndex, item) {
                            var store = view.getStore(),
                                record = store.getAt(rowIndex);

                            me.fireEvent('openArticle', record);
                        },
                        getClass: function(value, metadata, record) {
                            if (!record.get('articleId'))  {
                                return 'x-hidden';
                            }
                        }
                    }
                ]
            }
        );
        return columns;
    },
});
//{/block}