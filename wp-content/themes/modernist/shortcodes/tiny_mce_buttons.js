/*Heading 1*/
(function() {
    tinymce.create('tinymce.plugins.heading1', {
        init : function(ed, url) {
            ed.addButton('heading1', {
                title : 'Heading 1',
                image : url+'/img/h1.png',
                onclick : function() {
                     ed.selection.setContent('[h1]' + ed.selection.getContent() + '[/h1]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('heading1', tinymce.plugins.heading1);
})();
/*Heading 1*/

/*Heading 2*/
(function() {
    tinymce.create('tinymce.plugins.heading2', {
        init : function(ed, url) {
            ed.addButton('heading2', {
                title : 'Heading 2',
                image : url+'/img/h2.png',
                onclick : function() {
                     ed.selection.setContent('[h2]' + ed.selection.getContent() + '[/h2]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('heading2', tinymce.plugins.heading2);
})();
/*Heading 2*/

/*Heading 3*/
(function() {
    tinymce.create('tinymce.plugins.heading3', {
        init : function(ed, url) {
            ed.addButton('heading3', {
                title : 'Heading 3',
                image : url+'/img/h3.png',
                onclick : function() {
                     ed.selection.setContent('[h3]' + ed.selection.getContent() + '[/h3]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('heading3', tinymce.plugins.heading3);
})();
/*Heading 3*/

/*Heading 4*/
(function() {
    tinymce.create('tinymce.plugins.heading4', {
        init : function(ed, url) {
            ed.addButton('heading4', {
                title : 'Heading 4',
                image : url+'/img/h4.png',
                onclick : function() {
                     ed.selection.setContent('[h4]' + ed.selection.getContent() + '[/h4]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('heading4', tinymce.plugins.heading4);
})();
/*Heading 4*/

/*Heading 5*/
(function() {
    tinymce.create('tinymce.plugins.heading5', {
        init : function(ed, url) {
            ed.addButton('heading5', {
                title : 'Heading 5',
                image : url+'/img/h5.png',
                onclick : function() {
                     ed.selection.setContent('[h5]' + ed.selection.getContent() + '[/h5]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('heading5', tinymce.plugins.heading5);
})();
/*Heading 5*/

/*Buttons*/
(function() {
    tinymce.create('tinymce.plugins.buttons', {
        init : function(ed, url) {
            ed.addButton('buttons', {
                title : 'Buttons',
                image : url+'/img/buttons.png',
                onclick : function() {
                     ed.selection.setContent('[button href="" type="button_01"]' + ed.selection.getContent() + '[/button]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttons', tinymce.plugins.buttons);
})();
/*Buttons*/

/*Blockquote*/
(function() {
    tinymce.create('tinymce.plugins.blockquote', {
        init : function(ed, url) {
            ed.addButton('blockquote', {
                title : 'Blockquote',
                image : url+'/img/quote.png',
                onclick : function() {
                     ed.selection.setContent('[blockquote]' + ed.selection.getContent() + '[/blockquote]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('blockquote', tinymce.plugins.blockquote);
})();
/*Blockquote*/

/*Blockquote*/
(function() {
    tinymce.create('tinymce.plugins.dropcap', {
        init : function(ed, url) {
            ed.addButton('dropcap', {
                title : 'Dropcap',
                image : url+'/img/paragraph.png',
                onclick : function() {
                     ed.selection.setContent('[dropcap]' + ed.selection.getContent() + '[/dropcap]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);
})();
/*Blockquote*/

/*Blockquote*/
(function() {
    tinymce.create('tinymce.plugins.alert', {
        init : function(ed, url) {
            ed.addButton('alert', {
                title : 'Alert',
                image : url+'/img/notification.png',
                onclick : function() {
                     ed.selection.setContent('[alert type=""]' + ed.selection.getContent() + '[/alert]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alert', tinymce.plugins.alert);
})();
/*Blockquote*/

/*tab*/
(function() {
    tinymce.create('tinymce.plugins.accordion', {
        init : function(ed, url) {
            ed.addButton('accordion', {
                title : 'Accordion',
                image : url+'/img/toggle.png',
                onclick : function() {
                     ed.selection.setContent('[accordiongroup][accordion title=""]'+ed.selection.getContent()+'[/accordion][/accordiongroup]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();
/*tab*/

/*tab*/
(function() {
    tinymce.create('tinymce.plugins.tabgroup', {
        init : function(ed, url) {
            ed.addButton('tabgroup', {
                title : 'Tabs',
                image : url+'/img/tab.png',
                onclick : function() {
                     ed.selection.setContent('[tabgroup][tab title=""]'+ed.selection.getContent()+'[/tab][/tabgroup]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('tabgroup', tinymce.plugins.tabgroup);
})();
/*tab*/

/*list*/
(function() {
    tinymce.create('tinymce.plugins.list', {
        init : function(ed, url) {
            ed.addButton('list', {
                title : 'Lists',
                image : url+'/img/ulist.png',
                onclick : function() {
                     ed.selection.setContent('[list type=""][listitem]'+ed.selection.getContent()+'[/listitem][/list]'); 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('list', tinymce.plugins.list);
})();
/*list*/