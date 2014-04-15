/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 01.04.14
 * @time 9:09
 * Created by JetBrains PhpStorm.
 */
function MapTooltip(opt_options) {
    this.extend(MapTooltip, google.maps.OverlayView);
    this.isOpen_ = false;
    this.isFix_ = false;
    var options = opt_options || {};
    if (options['disableAutoPan'] == undefined) {
        options['disableAutoPan'] = false;
    }
    if (options['styles']['background-color'] == undefined) {
        options['styles']['background-color'] = this.BACKGROUND_COLOR_;
    }
    if (options['styles']['border-radius'] == undefined) {
        options['styles']['border-radius'] = this.BORDER_RADIUS_;
    }
    if (options['styles']['color'] == undefined) {
        options['styles']['color'] = this.COLOR_;
    }
    if (options['styles']['position'] == undefined) {
        options['styles']['position'] = this.POSITION_;
    }
    if (options['styles']['overflow'] == undefined) {
        options['styles']['overflow'] = this.OVERFLOW_;
    }

    this.setValues(options);
    this.createDOM();
}

MapTooltip.prototype.BORDER_RADIUS_ = 5;
MapTooltip.prototype.BACKGROUND_COLOR_ = '#292C3A';
MapTooltip.prototype.COLOR_ = '#000000';
MapTooltip.prototype.POSITION_ = 'absolute';
MapTooltip.prototype.OVERFLOW_ = 'auto';

MapTooltip.prototype.createDOM = function(){
    // Create dom
    var that = this;

    // Tooltip
    var tooltip = document.getElementById('tooltipWrapper');
    if(!tooltip){
        tooltip = document.createElement('DIV');
        tooltip.id = "tooltipWrapper";
    } else {
        tooltip.innerHTML = "";
    }
    that.tooltip_ = tooltip;

    for(style in that.styles){
        if(isNaN(+that.styles[style])){
            tooltip.style[style] = that.styles[style];
        } else {
            tooltip.style[style] = that.px(that.styles[style]);
        }
    }

    if (typeof that.content == 'string') {
        that.content = that.htmlToDocumentFragment_(that.content);
    }
    if(that.content){
        tooltip.style['display'] = 'none';
        tooltip.appendChild(that.content);
    }
};

MapTooltip.prototype.extend = function(obj1, obj2) {
    return (function(object) {
        for (var property in object.prototype) {
            this.prototype[property] = object.prototype[property];
        }
        return this;
    }).apply(obj1, [obj2]);
};

MapTooltip.prototype.getAnchor = function() {
    return (this.get('anchor'));
}
MapTooltip.prototype['getAnchor'] = MapTooltip.prototype.getAnchor;

MapTooltip.prototype.getContent = function() {
    return /** @type {Node|string} */ (this.get('content'));
};
MapTooltip.prototype['getContent'] = MapTooltip.prototype.getContent;

MapTooltip.prototype.getPosition = function() {
    var anchor = this.get('anchor');
    if(!anchor){
        return;
    }
    return /** @type {google.maps.LatLng} */ (anchor.get('position'));
};
MapTooltip.prototype['getPosition'] = MapTooltip.prototype.getPosition;

MapTooltip.prototype.htmlToDocumentFragment_ = function(htmlString) {
    htmlString = htmlString.replace(/^\s*([\S\s]*)\b\s*$/, '$1');
    var tempDiv = document.createElement('DIV');
    tempDiv.innerHTML = htmlString;
    if (tempDiv.childNodes.length == 1) {
        return /** @type {!Node} */ (tempDiv.removeChild(tempDiv.firstChild));
    } else {
        var fragment = document.createDocumentFragment();
        while (tempDiv.firstChild) {
            fragment.appendChild(tempDiv.firstChild);
        }
        return fragment;
    }
};

MapTooltip.prototype.isOpen = function() {
    return this.isOpen_;
};
MapTooltip.prototype['isOpen'] = MapTooltip.prototype.isOpen;

MapTooltip.prototype.isFix = function() {
    return this.isFix_;
};
MapTooltip.prototype['isFix'] = MapTooltip.prototype.isFix;

MapTooltip.prototype.setFix = function(fix) {
    this.isFix_ = fix;
};
MapTooltip.prototype['setFix'] = MapTooltip.prototype.setFix;

MapTooltip.prototype.open = function(opt_map, opt_anchor, content) {
    if(this.isOpen_){
        this.close();
    } else {
        this.open_(opt_map, opt_anchor, content);
    }
};
MapTooltip.prototype.open_ = function(opt_map, opt_anchor, content) {
    if (opt_map) {
        this.set('map',opt_map);
    }
    if (opt_anchor) {
        this.set('anchor', opt_anchor);
    }
    if (content) {
        this.set('content', content);
        this.createDOM();
    }
    this.tooltip_.style['display'] = '';
    this.isOpen_ = true;
    this.draw();
};
MapTooltip.prototype['open'] = MapTooltip.prototype.open;

MapTooltip.prototype.close = function() {
    this.tooltip_.style['display'] = "none";
    this.isOpen_ = false;
    this.isFix_ = false;
};
MapTooltip.prototype['close'] = MapTooltip.prototype.close;

MapTooltip.prototype.draw = function() {
    if(!this.isOpen_){
        return;
    }
    var projection = this.getProjection();

    if (!projection) {
        // The map projection is not ready yet so do nothing
        return;
    }

    var latLng = /** @type {google.maps.LatLng} */ (this.getPosition());

    if (!latLng) {
        this.close();
        return;
    }

    var pos = projection.fromLatLngToDivPixel(latLng);

    var tooltip = this.tooltip_;

    tooltip.style['top'] = this.px(pos.y);
    tooltip.style['left'] = this.px(pos.x);
    tooltip.style['display'] = 'block';
};
MapTooltip.prototype['draw'] = MapTooltip.prototype.draw;

MapTooltip.prototype.onAdd = function() {
    var panes = this.getPanes();
    if (panes) {
        panes.floatPane.appendChild(this.tooltip_);
    }
};
MapTooltip.prototype['onAdd'] = MapTooltip.prototype.onAdd;

MapTooltip.prototype.px = function(num) {
    if (num) {
        // 0 doesn't need to be wrapped
        return num + 'px';
    }
    return num;
};

MapTooltip.prototype.onRemove = function() {
};
MapTooltip.prototype['onRemove'] = MapTooltip.prototype.onRemove;

MapTooltip.prototype.getElementSize_ = function(element, opt_maxWidth,
                                                opt_maxHeight) {
    var sizer = document.createElement('DIV');
    sizer.style['display'] = 'inline';
    sizer.style['position'] = 'absolute';
    sizer.style['z-index'] = '-1';
    sizer.style['top'] = '0';
    sizer.style['left'] = '0';

    if (typeof element == 'string') {
        sizer.innerHTML = element;
    } else {
        sizer.appendChild(element.cloneNode(true));
    }

    document.body.appendChild(sizer);
    var size = new google.maps.Size(sizer.offsetWidth, sizer.offsetHeight);

    // If the width is bigger than the max width then set the width and size again
    if (opt_maxWidth && size.width > opt_maxWidth) {
        sizer.style['width'] = this.px(opt_maxWidth);
        size = new google.maps.Size(sizer.offsetWidth, sizer.offsetHeight);
    }

    // If the height is bigger than the max height then set the height and size
    // again
    if (opt_maxHeight && size.height > opt_maxHeight) {
        sizer.style['height'] = this.px(opt_maxHeight);
        size = new google.maps.Size(sizer.offsetWidth, sizer.offsetHeight);
    }

    document.body.removeChild(sizer);
    delete sizer;
    return size;
};