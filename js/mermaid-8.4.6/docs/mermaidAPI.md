<!-- Generated by documentation.js. Update this documentation by updating the source code. -->

## mermaidAPI

This is the api to be used when optionally handling the integration with the web page, instead of using the default integration provided by mermaid.js.

The core of this api is the [**render**][1] function which, given a graph
definition as text, renders the graph/diagram and returns an svg element for the graph.

It is is then up to the user of the API to make use of the svg, either insert it somewhere in the page or do something completely different.

In addition to the render function, a number of behavioral configuration options are available.

## Configuration

These are the default options which can be overridden with the initialization call like so:
**Example 1:**

<pre>
mermaid.initialize({
  flowchart:{
    htmlLabels: false
  }
});
</pre>

**Example 2:**

<pre>
&lt;script>
  var config = {
    startOnLoad:true,
    flowchart:{
      useMaxWidth:true,
      htmlLabels:true,
      curve:'cardinal',
    },

    securityLevel:'loose',
  };
  mermaid.initialize(config);
&lt;/script>
</pre>

A summary of all options and their defaults is found [here][2]. A description of each option follows below.

## theme

theme , the CSS style sheet

**theme** - Choose one of the built-in themes:

-   default
-   forest
-   dark
-   neutral.
    To disable any pre-defined mermaid theme, use "null".

**themeCSS** - Use your own CSS. This overrides **theme**.

<pre>
 "theme": "forest",
 "themeCSS": ".node rect { fill: red; }"
</pre>

## fontFamily

**fontFamily** The font to be used for the rendered diagrams. Default value is \\"trebuchet ms\\", verdana, arial;

## logLevel

This option decides the amount of logging to be used.

-   debug: 1
-   info: 2
-   warn: 3
-   error: 4
-   fatal: (**default**) 5

## securityLevel

Sets the level of trust to be used on the parsed diagrams.

-   **strict**: (**default**) tags in text are encoded, click functionality is disabeled
-   **loose**: tags in text are allowed, click functionality is enabled

## startOnLoad

This options controls whether or mermaid starts when the page loads
**Default value true**.

## arrowMarkerAbsolute

This options controls whether or arrow markers in html code will be absolute paths or
an anchor, #. This matters if you are using base tag settings.
**Default value false**.

## flowchart

The object containing configurations specific for flowcharts

### htmlLabels

Flag for setting whether or not a html tag should be used for rendering labels
on the edges.
**Default value true**.

### nodeSpacing

Defines the spacing between nodes on the same level (meaning horizontal spacing for
TB or BT graphs, and the vertical spacing for LR as well as RL graphs).
**Default value 50**.

### rankSpacing

Defines the spacing between nodes on different levels (meaning vertical spacing for
TB or BT graphs, and the horizontal spacing for LR as well as RL graphs).
**Default value 50**.

### curve

How mermaid renders curves for flowcharts. Possible values are

-   basis
-   linear **default**
-   cardinal

## sequence

The object containing configurations specific for sequence diagrams

### diagramMarginX

margin to the right and left of the sequence diagram.
**Default value 50**.

### diagramMarginY

margin to the over and under the sequence diagram.
**Default value 10**.

### actorMargin

Margin between actors.
**Default value 50**.

### width

Width of actor boxes
**Default value 150**.

### height

Height of actor boxes
**Default value 65**.

### boxMargin

Margin around loop boxes
**Default value 10**.

### boxTextMargin

margin around the text in loop/alt/opt boxes
**Default value 5**.

### noteMargin

margin around notes.
**Default value 10**.

### messageMargin

Space between messages.
**Default value 35**.

### mirrorActors

mirror actors under diagram.
**Default value true**.

### bottomMarginAdj

Depending on css styling this might need adjustment.
Prolongs the edge of the diagram downwards.
**Default value 1**.

### useMaxWidth

when this flag is set the height and width is set to 100% and is then scaling with the
available space if not the absolute space required is used.
**Default value true**.

### rightAngles

This will display arrows that start and begin at the same node as right angles, rather than a curve
**Default value false**.

### showSequenceNumbers

This will show the node numbers
**Default value false**.

## gantt

The object containing configurations specific for gantt diagrams\*

### titleTopMargin

Margin top for the text over the gantt diagram
**Default value 25**.

### barHeight

The height of the bars in the graph
**Default value 20**.

### barGap

The margin between the different activities in the gantt diagram.
**Default value 4**.

### topPadding

Margin between title and gantt diagram and between axis and gantt diagram.
**Default value 50**.

### leftPadding

The space allocated for the section name to the left of the activities.
**Default value 75**.

### gridLineStartPadding

Vertical starting position of the grid lines.
**Default value 35**.

### fontSize

Font size ...
**Default value 11**.

### fontFamily

font family ...
**Default value '"Open-Sans", "sans-serif"'**.

### numberSectionStyles

The number of alternating section styles.
**Default value 4**.

### axisFormat

Datetime format of the axis. This might need adjustment to match your locale and preferences
**Default value '%Y-%m-%d'**.

## render

Function that renders an svg with a graph from a chart definition. Usage example below.

```js
mermaidAPI.initialize({
     startOnLoad:true
 });
 $(function(){
     const graphDefinition = 'graph TB\na-->b';
     const cb = function(svgGraph){
         console.log(svgGraph);
     };
     mermaidAPI.render('id1',graphDefinition,cb);
 });
```

### Parameters

-   `id`  the id of the element to be rendered
-   `txt`  the graph definition
-   `cb`  callback which is called after rendering is finished with the svg code as inparam.
-   `container`  selector to element in which a div with the graph temporarily will be inserted. In one is
    provided a hidden div will be inserted in the body of the page instead. The element will be removed when rendering is
    completed.

## 

## mermaidAPI configuration defaults

<pre>

&lt;script>
  var config = {
    theme:'default',
    logLevel:'fatal',
    securityLevel:'strict',
    startOnLoad:true,
    arrowMarkerAbsolute:false,

    flowchart:{
      htmlLabels:true,
      curve:'linear',
    },
    sequence:{
      diagramMarginX:50,
      diagramMarginY:10,
      actorMargin:50,
      width:150,
      height:65,
      boxMargin:10,
      boxTextMargin:5,
      noteMargin:10,
      messageMargin:35,
      mirrorActors:true,
      bottomMarginAdj:1,
      useMaxWidth:true,
      rightAngles:false,
      showSequenceNumbers:false,
    },
    gantt:{
      titleTopMargin:25,
      barHeight:20,
      barGap:4,
      topPadding:50,
      leftPadding:75,
      gridLineStartPadding:35,
      fontSize:11,
      fontFamily:'"Open-Sans", "sans-serif"',
      numberSectionStyles:4,
      axisFormat:'%Y-%m-%d',
    }
  };
  mermaid.initialize(config);
&lt;/script>
</pre>

[1]: https://github.com/knsv/mermaid/blob/master/docs/mermaidAPI.md#render

[2]: https://github.com/knsv/mermaid/blob/master/docs/mermaidAPI.md#mermaidapi-configuration-defaults