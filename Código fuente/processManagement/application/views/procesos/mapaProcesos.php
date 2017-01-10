
<script>

var base_url='';
  
  function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates
    myDiagram =
      $(go.Diagram, "myDiagramPro",  // must name or refer to the DIV HTML element
        {
          initialContentAlignment: go.Spot.Center,
          allowDrop: true,  // must be true to accept drops from the Palette
          "LinkDrawn": showLinkLabel,  // this DiagramEvent listener is defined below
          "LinkRelinked": showLinkLabel,
          // "animationManager.duration": 800, // slightly longer than default (600ms) animation
          "undoManager.isEnabled": true  // enable undo & redo
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });
    // helper definitions for node templates
    function nodeStyle() {
      return [
        // The Node.location comes from the "loc" property of the node data,
        // converted by the Point.parse static method.
        // If the Node.location is changed, it updates the "loc" property of the node data,
        // converting back using the Point.stringify static method.
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
          // the Node.location is at the center of each node
          locationSpot: go.Spot.Center,
          padding: 10,
          deletable: false,
          copyable: false,
          //isShadowed: true,
          //shadowColor: "#888",
          // handle mouse enter/leave events to show/hide the ports
          mouseEnter: function (e, obj) { showPorts(obj.part, true); },
          mouseLeave: function (e, obj) { showPorts(obj.part, false); }
        }
      ];
    }

    function contenedorStyle() {
      return [
        // The Node.location comes from the "loc" property of the node data,
        // converted by the Point.parse static method.
        // If the Node.location is changed, it updates the "loc" property of the node data,
        // converting back using the Point.stringify static method.
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
          // the Node.location is at the center of each node
          locationSpot: go.Spot.Center,
          padding: 10,
          movable: false,
          deletable: false,
          copyable: false,

          //isShadowed: true,
          //shadowColor: "#888",
          // handle mouse enter/leave events to show/hide the ports
          mouseEnter: function (e, obj) { showPorts(obj.part, true); },
          mouseLeave: function (e, obj) { showPorts(obj.part, false); }
        }
      ];
    }
    // Define a function for creating a "port" that is normally transparent.
    // The "name" is used as the GraphObject.portId, the "spot" is used to control how links connect
    // and where the port is positioned on the node, and the boolean "output" and "input" arguments
    // control whether the user can draw links from or to the port.
    function makePort(name, spot, output, input) {
      // the port is basically just a small circle that has a white stroke when it is made visible
      return $(go.Shape, "Circle",
               {
                  fill: "transparent",
                  stroke: null,  // this is changed to "white" in the showPorts function
                  desiredSize: new go.Size(8, 8),
                  alignment: spot, alignmentFocus: spot,  // align the port on the main Shape
                  portId: name,  // declare this object to be a "port"
                  fromSpot: spot, toSpot: spot,  // declare where links may connect at this port
                  fromLinkable: output, toLinkable: input,  // declare whether the user may draw links to/from here
                  cursor: "pointer"  // show a different cursor to indicate potential link point
               });
    }
    // define the Node templates for regular nodes
    var lightText = 'whitesmoke';
    myDiagram.nodeTemplateMap.add("",  // the default category
      $(go.Node, "Spot", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#00A9C9", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, true, true),
        makePort("L", go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, true, true)
      ));
    myDiagram.nodeTemplateMap.add("Estrategicos",  // the default category
      $(go.Node, "Spot",{ resizable: true,
          doubleClick: function(e, obj) { showCaracterizacion(obj.part.data.key, '<?php echo base_url(); ?>'); }
        }, nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#173457", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              editable: false
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false),
        makePort("B", go.Spot.Bottom, false, false)
      ));
    myDiagram.nodeTemplateMap.add("Primario",  // the default category
      $(go.Node, "Spot",{ resizable: true, doubleClick: function(e, obj) { showCaracterizacion(obj.part.data.key, '<?php echo base_url(); ?>'); } }, nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#388e3c", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false),
        makePort("B", go.Spot.Bottom, false, false)
      ));

     myDiagram.nodeTemplateMap.add("PApoyo",  // the default category
      $(go.Node, "Spot", { resizable: true, 
        doubleClick: function(e, obj) { showCaracterizacion(obj.part.data.key, '<?php echo base_url(); ?>'); } 
      }, nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { fill: "#e88818", stroke: null },
            new go.Binding("figure", "figure")),
          $(go.TextBlock,
            {
              font: "bold 11pt Helvetica, Arial, sans-serif",
              stroke: lightText,
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: false
            },
            new go.Binding("text", "text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false),
        makePort("B", go.Spot.Bottom, false, false)
      ));

    myDiagram.nodeTemplateMap.add("Start",
      $(go.Node, "Spot", contenedorStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { maxSize: new go.Size(40, 450),minSize: new go.Size(40, 450), fill: "#6A0888", stroke: null }),
          $(go.TextBlock, "R\nE\nQ\nU\nE\nR\nI\nM\nI\nE\nN\nT\nO\n \nD\nE\nL\n \nC\nL\nI\nE\nN\nT\nE",
            { margin: 5, font: "bold 9pt Helvetica, Arial, sans-serif", stroke: lightText,editable: false  })
        ),
        // three named ports, one on each side except the top, all output only:
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false),
        makePort("T", go.Spot.Top, true, false),
        makePort("B", go.Spot.Bottom, true, false)
      ));

    myDiagram.nodeTemplateMap.add("End",
      $(go.Node, "Spot", contenedorStyle(),
        $(go.Panel, "Auto",
          $(go.Shape, "Rectangle",
            { maxSize: new go.Size(40, 450),minSize: new go.Size(40, 450),  fill: "#6A0888", stroke: null }),
          $(go.TextBlock, "S\nA\nT\nI\nS\nF\nA\nC\nC\nI\nO\nN\n \nD\nE\nL\n \nC\nL\nI\nE\nN\nT\nE\n",
            { margin: 5, font: "bold 11pt Helvetica, Arial, sans-serif", stroke: lightText,editable: false })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false,true),
        makePort("B", go.Spot.Bottom, false, true),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false)
      ));

    myDiagram.nodeTemplateMap.add("ContenedorPrimario",
      $(go.Node, "Spot", contenedorStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 300), fill: "#c8e6c9", stroke: null }),
          $(go.TextBlock, "Procesos Primarios",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, false),
        makePort("R", go.Spot.Right, false, false), 
        makePort("B", go.Spot.Bottom, false, false)
      ));
    myDiagram.nodeTemplateMap.add("ContenedorApoyo",
      $(go.Node, "Spot", contenedorStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 150), fill: "#e7b05b", stroke: null }),
          $(go.TextBlock, "Procesos Apoyo",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, true),
        makePort("R", go.Spot.Right, true, false),
        makePort("B", go.Spot.Bottom, false, false)
      ));

    myDiagram.nodeTemplateMap.add("ContenedorEstrategico",
      $(go.Node, "Spot", contenedorStyle(),$(go.Panel, "Vertical",
        $(go.Shape, "Rectangle",{ minSize: new go.Size(700, 150), fill: "#b1c6e0", stroke: null }),
          $(go.TextBlock, "Procesos Estrategicos",{  font: "bold 11pt Helvetica, Arial",textAlign: "start" })
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("T", go.Spot.Top, false, false),
        makePort("L", go.Spot.Left, false, true),
        makePort("R", go.Spot.Right, true, false),
        makePort("B", go.Spot.Bottom, false, false)
      ));


    // myDiagram.nodeTemplateMap.add("Comment",
    //   $(go.Node, "Auto", nodeStyle(),
    //     $(go.Shape, "File",
    //       { fill: "#EFFAB4", stroke: null }),
    //     $(go.TextBlock,
    //       {
    //         margin: 5,
    //         maxSize: new go.Size(200, NaN),
    //         wrap: go.TextBlock.WrapFit,
    //         textAlign: "center",
    //         editable: false,
    //         font: "bold 12pt Helvetica, Arial, sans-serif",
    //         stroke: '#454545'
    //       },
    //       new go.Binding("text").makeTwoWay())
    //     // no ports, because no links are allowed to connect with a comment
    //   ));


    // myDiagram.groupTemplate =
    // $(go.Group, "Vertical",
    //   { selectionObjectName: "PH",
    //     locationObjectName: "PH",
    //     resizable: true,
    //     resizeObjectName: "PH" }
    //   // new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
    //   // $(go.TextBlock,  // group title
    //   //   { font: "Bold 12pt Sans-Serif" },
    //   //   new go.Binding("text", "text")),
    //   // $(go.Shape,  // using a Shape instead of a Placeholder
    //   //   { name: "PH",
    //   //     fill: "lightyellow" }
    //   //   // new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify)
    //   //   )
    // );

     function highlightGroup(e, grp, show) {
              if (!grp) return;
              e.handled = true;
              if (show) {
                  // cannot depend on the grp.diagram.selection in the case of external drag-and-drops;
                  // instead depend on the DraggingTool.draggedParts or .copiedParts
                  var tool = grp.diagram.toolManager.draggingTool;
                  var map = tool.draggedParts || tool.copiedParts;  // this is a Map
                  // now we can check to see if the Group will accept membership of the dragged Parts
                  if (grp.canAddMembers(map.toKeySet())) {
                      grp.isHighlighted = true;
                      return;
                  }
              }
              grp.isHighlighted = false;
   }

    function finishDrop(e, grp) {
                var ok = grp !== null && grp.addMembers(grp.diagram.selection, true);
                if (!ok) grp.diagram.currentTool.doCancel();
    }
    // myDiagram.groupTemplateMap.add("MacroProceso",
    //         $(go.Group, go.Panel.Auto,
    //           {
    //               background: "transparent",

    //               // highlight when dragging into the Group
    //               mouseDragEnter: function(e, grp, prev) { highlightGroup(e, grp, true); },
    //               mouseDragLeave: function(e, grp, next) { highlightGroup(e, grp, false); },
    //               computesBoundsAfterDrag: true,
    //               // when the selection is dropped into a Group, add the selected Parts into that Group;
    //               // if it fails, cancel the tool, rolling back any changes
    //               mouseDrop: finishDrop,
    //               // Groups containing Groups lay out their members horizontally
    //               layout:
    //                 $(go.GridLayout,
    //                   { wrappingWidth: 1, alignment: go.GridLayout.Position,
    //                       cellSize: new go.Size(1, 1), spacing: new go.Size(4, 14) })
    //           },
    //           $(go.Panel, go.Panel.Vertical,
    //             $(go.Panel, go.Panel.Horizontal,
    //               { stretch: go.GraphObject.Horizontal, background: "#33D3E5" },
    //               $("SubGraphExpanderButton",
    //                 { alignment: go.Spot.Right, margin: 5 }),
    //               $(go.TextBlock,
    //                 { alignment: go.Spot.Left, editable: true,
    //                     margin: 5,
    //                     font: "bold 18px sans-serif",
    //                     stroke: "#9A6600"
    //                 },
    //                 new go.Binding("text", "text").makeTwoWay())
    //             ),  // end Horizontal Panel
    //             $(go.Placeholder,
    //               { padding: 5, alignment: go.Spot.TopLeft },
    //               new go.Binding("background", "isHighlighted", function(h) { return h ? "red": "transparent"; }).ofObject())
    //           ),  // end Vertical Panel
    //           $(go.Shape, "Rectangle",
    //             {
    //                 isPanelMain: true,  // the Rectangle Shape is in front of the Vertical Panel
    //                 fill: null,
    //                 stroke: "#E69900",
    //                 strokeWidth: 2,
    //             })
    //           )); 

    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        {
          routing: go.Link.AvoidsNodes,
          curve: go.Link.JumpOver,
          corner: 5, toShortLength: 4,
          relinkableFrom: true,
          relinkableTo: true,
          reshapable: true,
          resegmentable: true,
          // mouse-overs subtly highlight links:
          mouseEnter: function(e, link) { link.findObject("HIGHLIGHT").stroke = "rgba(30,144,255,0.2)"; },
          mouseLeave: function(e, link) { link.findObject("HIGHLIGHT").stroke = "transparent"; }
        },
        new go.Binding("points").makeTwoWay(),
        {deletable: false, copyable: false},
        $(go.Shape,  // the highlight shape, normally transparent
          { isPanelMain: true, strokeWidth: 8, stroke: "transparent", name: "HIGHLIGHT" }),
        $(go.Shape,  // the link path shape
          { isPanelMain: true, stroke: "gray", strokeWidth: 2 }),
        $(go.Shape,  // the arrowhead
          { toArrow: "standard", stroke: null, fill: "gray"}),
        $(go.Panel, "Auto",  // the link label, normally not visible
          { visible: false, name: "LABEL", segmentIndex: 2, segmentFraction: 0.5},
          new go.Binding("visible", "visible").makeTwoWay(),
          $(go.Shape, "RoundedRectangle",  // the label shape
            { fill: "#F8F8F8", stroke: null }),
          $(go.TextBlock, "Yes",  // the label
            {
              textAlign: "center",
              font: "10pt helvetica, arial, sans-serif",
              stroke: "#333333",
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        )
      );
    // Make link labels visible if coming out of a "conditional" node.
    // This listener is called by the "LinkDrawn" and "LinkRelinked" DiagramEvents.
    function showLinkLabel(e) {
      var label = e.subject.findObject("LABEL");
      if (label !== null) label.visible = (e.subject.fromNode.data.figure === "Diamond");
    }
    // temporary links used by LinkingTool and RelinkingTool are also orthogonal:
    myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
    myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;
    load();  // load an initial diagram from some JSON text
    // initialize the Palette that is on the left side of the page
    // myPalette =
    //   $(go.Palette, "myPaletteP",  // must name or refer to the DIV HTML element
    //     {
    //       "animationManager.duration": 800, // slightly longer than default (600ms) animation
    //       nodeTemplateMap: myDiagram.nodeTemplateMap,  // share the templates used by myDiagram
    //       model: new go.GraphLinksModel([  // specify the contents of the Palette
    //         { category: "Estrategicos", text: "Estrategico" },
    //         { category: "Primario", text: "Primario" },
    //         { category: "PApoyo", text: "Apoyo" },
    //         { category: "MacroProceso", text: "MacroProceso",isGroup:true},
    //         { category: "Comment", text: "Comment", figure: "RoundedRectangle" }
    //       ])
    //     });
  }
  // Make all ports on a node visible when the mouse is over the node
  function showPorts(node, show) {
    var diagram = node.diagram;
    if (!diagram || diagram.isReadOnly || !diagram.allowLink) return;
    node.ports.each(function(port) {
        port.stroke = (show ? "white" : null);
      });
  }

  // Show the diagram's model in JSON format that the user may edit
  // function save() {

    // mySavedModelProcesos=myDiagram.model.toJson();
    // myDiagram.isModified = false;
  //   //alert(mySavedModelProcesos);
  //       $.ajax({
  //           type: "POST",
  //           data: {mySavedModelProcesos,Guardar:'grabar',param_opcion:'grabar'},
  //           url: base_url+'index.php/csm/setGrafico',
  //           success: function(datos) {
  //               if (datos == '') {
  //                   document.getElementById("mySavedModelProcesos").value = myDiagram.model.toJson();
  //                   myDiagram.isModified = false;
  //               } else {
  //                   location.reload();
  //               }
  //           },
  //           error: function(datos) {
  //               document.getElementById("mySavedModelProcesos").value = myDiagram.model.toJson();
  //               myDiagram.isModified = false;
  //           }
  //    });   
      
  // }
// Show the diagram's model in JSON format that the user may edit
  // function cleanp(ruta,empresa){
    
  //       $.ajax({
  //           url: ruta+'index.php/csm/cleanMapaProcesos',
  //           type: 'POST',
  //           data: 'empresa='+empresa,
  //           success:function(respuesta){
  //             savep(ruta,empresa);
  //           },
  //           error: function(respuesta){
  //               alertify.error('Hubo un error al grabar los cambios');
  //           }
  //       });
  // }
  // Show the diagram's model in JSON format that the user may edit
  
  

</script>



<!--Page Content -->
      <div id="page-wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Mapa de procesos</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
          </div>

          <!-- /.container-fluid -->
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="panel panel-info">
                <div class="panel-body">
                    <div class="row">
                        <!-- START DIAGRAM -->
                        
                        <body onload="init()">
                            <div id="mapaProc">
                              <div style="width:100%; white-space:nowrap;">
                                <!-- <span style="display: inline-block; vertical-align: top; padding: 5px; width:200px">
                                  <div id="myPaletteP" style="border: solid 1px gray; height: 720px"></div>
                                </span> -->

                                <span style="display: inline-block; vertical-align: top; padding: 5px; width:100%">
                                  <div id="myDiagramPro" style="height: 720px"></div>
                                </span>
                              </div>

                              <textarea id="mySavedModelProcesos" style="width:100%;height:40px;visibility:hidden;">
                              { "class": "go.GraphLinksModel",
                              "linkFromPortIdProperty": "fromPort",
                              "linkToPortIdProperty": "toPort",
                              "nodeDataArray": [ 
                                <?php
                                      $contenedores = $this->modProcesos->getContenedoresMapa($usuario);
                                      if(isset($contenedores)){
                                          foreach($contenedores->result() as $dcontenedores){ 
                                            echo '{"key":'.$dcontenedores->PROCkey.', "category":"'.$dcontenedores->PROCcategory.'", "loc":"'.$dcontenedores->PROCloc.'","text":"'.$dcontenedores->PROCnombre.'"},'; 
                                          }
                                      }
                                      $this->db->reconnect();
                                      $procesos = $this->modProcesos->getProcesosMapa($usuario);
                                      if(isset($procesos)){
                                        $cont=intval(0);
                                          foreach($procesos->result() as $dprocesos){ 
                                            $cont=$cont+1;
                                            if($cont==intval($procesos->num_rows())){
                                              echo '{"key":'.$dprocesos->PROCkey.', "category":"'.$dprocesos->PROCcategory.'", "loc":"'.$dprocesos->PROCloc.'","isGroup":'.$dprocesos->PROCesMacro.',"group":"'.$dprocesos->PROCcodMacro.'","text":"'.$dprocesos->PROCnombre.'"}';
                                            }else{
                                              echo '{"key":'.$dprocesos->PROCkey.', "category":"'.$dprocesos->PROCcategory.'", "loc":"'.$dprocesos->PROCloc.'","isGroup":'.$dprocesos->PROCesMacro.',"group":"'.$dprocesos->PROCcodMacro.'","text":"'.$dprocesos->PROCnombre.'"},';  
                                            }                                                          
                                            
                                          }
                                      }

                                    ?>
                             ],
                              "linkDataArray": [ 
                                <?php
                                $this->db->reconnect();
                                $relacion = $this->modProcesos->getRelacionesMapa($usuario);
                                if(isset($relacion)){
                                  if($relacion){
                                    foreach($relacion->result() as $drelacion){ 
                                        echo '{"from":'.$drelacion->origen.', "to":'.$drelacion->destino.', "fromPort":"'.$drelacion->from.'", "toPort":"'.$drelacion->to.'"},';
                                    }
                                  }
                                }?>
                                {"from": 4, "to": 2, "fromPort": "R", "toPort": "L"},
                                {"from": 2, "to": 5, "fromPort": "R", "toPort": "L"},
                                {"from": 3, "to": 2, "fromPort": "B", "toPort": "T"},
                                {"from": 1, "to": 2, "fromPort": "T", "toPort": "B"}
                             ]}
                                
                              </textarea>
                            </div>                                       
                        </body>

                        <!-- INICIO BOTONES -->
                        <div class="row" style="padding-top:10px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-5" align="right">                                                                       
                                <input id="btnSaveMapaP" type="button" class="btn btn-block btn-lg btn-success" onClick="saveMapa('<?php echo base_url();?>', '<?php echo $this->session->userdata('usuario'); ?>');"value="Guardar Mapa de Procesos"> 
                            </div>
                           <!--  <div class="col-md-3" align="right">                                
                                <form role="form" method="POST" action="<?php //echo base_url(); ?>index.php/csm/getMapa">
                                  <input type="text" value="<?php //echo $empresaid; ?>" hidden name="txtEmpresaId" readonly>
                                  <input type="text" value="<?php //echo $empresa; ?>" hidden name="txtEmpresa" readonly>
                                  <input id="btnVerMapa" type="submit" class="btn btn-block btn-lg btn-danger" value="Cargar Mapa de Abastecimiento" id="btnNuevo" > 
                                </form>
                            </div> -->
                            <div class="col-md-3"></div>
                            <div class="clearfix"></div>                          
                        </div>
                        <!-- FIN BOTONES -->
                          
                        <!-- END DIAGRAM -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
              
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper