define(['uiComponent'], function (Component) {
    'use strict';
    console.log("component");
    return Component.extend({
        defaults: {
            template: 'MageMastery_Todo/todo'
        }
    });
});
