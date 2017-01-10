
<script>
    
function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates in this function

    myDiagram =
      $(go.Diagram, "myDiagramDiv",  // must be the ID or reference to div
        { initialContentAlignment: go.Spot.Center });

    // define all of the gradient brushes
    var graygrad = $(go.Brush, "Linear", { 0: "#F5F5F5", 1: "#F1F1F1" });
    var bluegrad = $(go.Brush, "Linear", { 0: "#CDDAF0", 1: "#91ADDD" });
    var yellowgrad = $(go.Brush, "Linear", { 0: "#FEC901", 1: "#FEA200" });
    var lavgrad = $(go.Brush, "Linear", { 0: "#EF9EFA", 1: "#A570AD" });

    // define the Node template for non-terminal nodes
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        { isShadowed: false },
        new go.Binding("key", "key"),
        // define the node's outer shape
        $(go.Shape, "RoundedRectangle",
          { fill: graygrad, stroke: "#D8D8D8" },
          new go.Binding("fill", "color")),
        // define the node's text
        $(go.TextBlock,
          { margin: 5, font: "bold 11px Helvetica, bold Arial, sans-serif" },
          new go.Binding("text", "text"))
      );

    // define the Link template
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        { selectable: false },
        $(go.Shape));  // the link shape

    // create the model for the double tree
    myDiagram.model = new go.TreeModel([
        // these node data are indented but not nested according to the depth in the tree
        { key: "Root", text: "<?php echo $this->session->userdata('empresa'); ?>", color: lavgrad},
            <?php
              // $usuario = $this->session->userdata('usuario');
              $provDirectos = $this->modMapa->getProvDirectos($usuario);
              if(isset($provDirectos)){
                foreach($provDirectos->result() as $dprovDirectos){ 
                    echo '{ key: "'.$dprovDirectos->child.'", text: "'.$dprovDirectos->nombre.'", parent: "Root", dir: "left", color: bluegrad },';
                }
            }?>
              <?php
              $this->db->reconnect();
              $provIndirectos = $this->modMapa->getProvIndirectos($usuario);
              if(isset($provIndirectos)){
                  foreach($provIndirectos->result() as $dprovIndirectos){ 
                      echo '{ key: "'.$dprovIndirectos->child.'", text: "'.$dprovIndirectos->nombre.'", parent: "'.$dprovIndirectos->parent.'" },';
                  }
              }?>
            <?php
              $this->db->reconnect();
              $cliDirectos = $this->modMapa->getCliDirectos($usuario);
              if(isset($cliDirectos)){
                foreach($cliDirectos->result() as $dcliDirectos){ 
                    echo '{ key: "'.$dcliDirectos->child.'", text: "'.$dcliDirectos->nombre.'", parent: "Root", dir: "right", color: bluegrad },';
                }
              }
              $this->db->reconnect();
              $cliIndirectos = $this->modMapa->getCliIndirectos($usuario);
              if(isset($cliIndirectos)){
                foreach($cliIndirectos->result() as $dcliIndirectos){ 
                    echo '{ key: "'.$dcliIndirectos->child.'", text: "'.$dcliIndirectos->nombre.'", parent: "'.$dcliIndirectos->parent.'" },';
                }
              }?>          
      ]);
    doubleTreeLayout(myDiagram);
  } 
</script>



<!--Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Diagrama de Cadena de Suministros (Supply Chain)</h1>
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
                                <div id="sample">
                                  <div id="myDiagramDiv" style="background-color: white; width: 100%; height: 600px">
                                  </div>
                                </div>
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