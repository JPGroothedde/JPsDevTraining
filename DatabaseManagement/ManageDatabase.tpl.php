<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
require(__CONFIGURATION__ . '/HeaderComponents/standard_header_init.inc.php');

$this->RenderBegin();
$DataModel = new DataModel();
initDeltaDB($DataModel);
function initDeltaDB(DataModel $dM) {
	$DbDeltaFile = fopen(__DOCROOT__.__DBMNG__.'/DataModeller/DataModel_Delta.json', "w") or die("Unable to open file!");
	$CurrentDBModelstr = '';
	$CurrentDBModelstr .= json_encode($dM);
	fwrite($DbDeltaFile, $CurrentDBModelstr);
	fclose($DbDeltaFile);
}
$CurrentCoords = null;
if (!is_file(__DOCROOT__.__DBMNG__.'/DataModeller/DataModel_Coordinates.json')) {
	$DbCoordsFile = fopen(__DOCROOT__.__DBMNG__.'/DataModeller/DataModel_Coordinates.json', "w") or die("Unable to open file!");
	fwrite($DbCoordsFile, '');
	fclose($DbCoordsFile);
}

$CurrentCoords = file_get_contents(__DOCROOT__.__DBMNG__.'/DataModeller/DataModel_Coordinates.json');
if (strlen($CurrentCoords) > 0)
	$CurrentCoords = json_decode($CurrentCoords);
else
	$CurrentCoords = null;

function getXForObject($CurrentCoords = null,$name = '') {
	if (!$CurrentCoords)
		return -1;
	if (!property_exists($CurrentCoords,$name))
		return -1;
	$xy = explode(',',$CurrentCoords->$name);
	return $xy[0];
	
}
function getYForObject($CurrentCoords = null,$name = '') {
	if (!$CurrentCoords)
		return -1;
	if (!property_exists($CurrentCoords,$name))
		return -1;
	$xy = explode(',',$CurrentCoords->$name);
	return $xy[1];
}

?>
<style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__); ?>/jointjs/joint.css");</style>
<style>
    body {
        padding-top:0px;
    }
</style>
<div class="container-fluid">
    <div class="modal fade" id="ConfirmPassword" tabindex="-1" role="dialog" aria-labelledby="ConfirmPasswordLabel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ConfirmPasswordLabel">Confirm Password</h4>
                </div>
                <div class="modal-body">
					<?php $this->txtPassword->Render();?>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
							<?php $this->btnConfirm->Render();?>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <h3 class="page-header">Database Management</h3>
        </div>
        <div class="col-md-3">
            <h4 class="page-header">Database Actions</h4>
            <div class="row">
                <div class="col-lg-6"> <?php $this->btnCleanResetDB->Render();?></div>
                <div class="col-lg-6"> <?php $this->btnSyncCaseSensitive->Render();?></div>
                <div class="col-lg-6"> <?php $this->btnRestoreLastReset->Render();?></div>
                <div class="col-lg-6"> <?php $this->btnRestoreLastSync->Render();?></div>
                <div class="col-md-12"> <?php $this->btnDone->Render();?></div>
                <div id="OutputWrapper" class="col-md-12" style="height:100%;overflow-y: scroll;"> <?php $this->sh_Output->Render();?></div>
            </div>
        </div>
        <div id="DataModelContainer" class="col-md-9" style="border:2px solid #dcdcdc">
            <div id="DataModel"></div>
        </div>
    </div>
</div>


<?php $this->RenderEnd() ?>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/jointjs/jquery.min.js"></script>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/jointjs/lodash.min.js"></script>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/jointjs/backbone-min.js"></script>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/jointjs/joint.min.js"></script>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/jointjs/svg-pan-zoom.min.js"></script>

<script>
	var w = $('#DataModelContainer').width();
	var h = window.innerHeight-80;
	var graph = new joint.dia.Graph();
	
	var paper = new joint.dia.Paper({
		el: $('#DataModel'),
		width: w,
		height: h,
		gridSize: 1,
		model: graph
	});
	
	
	var uml = joint.shapes.uml;
	var classes = {
	//TODO: Figure out how to space entities
	<?php for ($i=0;$i<sizeof($DataModel->objects);$i++) {
	$attrStr = '';
	$attrCount = sizeof($DataModel->objectAttributes[$DataModel->objects[$i]]);
	$classHeight = $attrCount*12+50;
	$maxAttrWidth = 160;
	for($k=0;$k<$attrCount;$k++) {
		$attrStr .= '\''.$DataModel->objectAttributes[$DataModel->objects[$i]][$k].': '.$DataModel->objectAttributeTypes[$DataModel->objects[$i]][$k].'\',';
		$strLength = strlen('\''.$DataModel->objectAttributes[$DataModel->objects[$i]][$k].': '.$DataModel->objectAttributeTypes[$DataModel->objects[$i]][$k].'\',')*6.3;
		if ($strLength > $maxAttrWidth)
			$maxAttrWidth = $strLength;
	}
	$classColor = '#5bc0de';
	if (in_array($DataModel->objects[$i],$DataModel->sDevBaseObjects)) {
		$classColor = '#dff0d8';
	}
	?>
	
	
	<?php echo $DataModel->objects[$i];?>: new uml.Class({
		position: { x: (<?php echo getXForObject($CurrentCoords,$DataModel->objects[$i]);?> > -1) ? <?php echo getXForObject($CurrentCoords,$DataModel->objects[$i]);?> : Math.floor(Math.random() * (w + 1)),
		y: (<?php echo getYForObject($CurrentCoords,$DataModel->objects[$i]);?> > -1) ? <?php echo getYForObject($CurrentCoords,$DataModel->objects[$i]);?> : Math.floor(Math.random() * (h + 1))},
	size: { width: <?php echo $maxAttrWidth;?>, height: <?php echo $classHeight;?> },
	name: '<?php echo $DataModel->objects[$i];?>',
		attributes: [<?php echo $attrStr;?>],
		methods: [],
		inPorts: ['in1','in2'],
		outPorts: ['out'],
		ports: {
		groups: {
			'in': {
				attrs: {
					'.port-body': {
						fill: '#16A085'
					}
				}
			},
			'out': {
				attrs: {
					'.port-body': {
						fill: '#E74C3C'
					}
				}
			}
		}
	},
	attrs: {
		'.uml-class-name-rect': {
			fill: '<?php echo $classColor;?>',
				stroke: '#fff',
				'stroke-width': 0.9
		},
		'.uml-class-attrs-rect, .uml-class-methods-rect': {
			fill: '<?php echo $classColor;?>',
				stroke: '#fff',
				'stroke-width': 1.0,
		},
		'.uml-class-attrs-text': {
			'ref-y': 0.5,
				'y-alignment': 'middle'
		},
		rect: { fill: '#2C3E50', rx: 5, ry: 5, 'stroke-width': 1 },
	},
	}),
	<?php
	}?>
	
	
	};
	
	_.each(classes, function(c) { graph.addCell(c); });
	<?php
	$relStr = '';
	for ($i=0;$i<sizeof($DataModel->objects);$i++) {
		$relCount = 0;
		if (array_key_exists($DataModel->objects[$i],$DataModel->objectSingleRelations)) {
			$relCount = sizeof($DataModel->objectSingleRelations[$DataModel->objects[$i]]);
		}
		for($k=0;$k<$relCount;$k++) {
			$relStr .= 'new uml.Transition({ source: { id: classes.'.$DataModel->objects[$i].'.id }, target: { id: classes.'.$DataModel->objectSingleRelations[$DataModel->objects[$i]][$k].'.id },smooth: true}),';
		}
	}
	?>
	var relations = [
		<?php echo $relStr;?>
		//new uml.Generalization({ source: { id: classes.man.id }, target: { id: classes.person.id }}),
		//new uml.Generalization({ source: { id: classes.woman.id }, target: { id: classes.person.id }}),
		//new uml.Implementation({ source: { id: classes.person.id }, target: { id: classes.mammal.id }}),
		//new uml.Aggregation({ source: { id: classes.person.id }, target: { id: classes.address.id }}),
		//new uml.Composition({ source: { id: classes.person.id }, target: { id: classes.bloodgroup.id }})
	];
	
	_.each(relations, function(r) { graph.addCell(r); });
	
	graph.on('transition:end', function(element) {
		
		console.log(element.id, ':', element.get('position'));
	});
	paper.on('cell:pointerup', function(cellView, evt, x, y) {
		
		// Find the first element below that is not a link nor the dragged element itself.
		var elementBelow = graph.get('cells').find(function(cell) {
			if (cell instanceof joint.dia.Link) return false; // Not interested in links.
			if (cell.id === cellView.model.id) return false; // The same element as the dropped one.
			if (cell.getBBox().containsPoint(g.point(x, y))) {
				return true;
			}
			return false;
		});
		
		// If the two elements are connected already, don't
		// connect them again (this is application specific though).
		if (elementBelow && !_.contains(graph.getNeighbors(elementBelow), cellView.model)) {
			
			graph.addCell(new joint.dia.Link({
				source: { id: cellView.model.id }, target: { id: elementBelow.id },
				attrs: { '.marker-source': { d: 'M 10 0 L 0 5 L 10 10 z' } },
				smooth: true
			}));
			// Move the element a bit to the side.
			cellView.model.translate(-200, 0);
		}
		
		// Update positions in file
		updateObjectCoordinates();
	});
	
	var panAndZoom = svgPanZoom('#v-2', {
		viewportSelector: '.svg-pan-zoom_viewport'
		, panEnabled: false
		, controlIconsEnabled: true
		, zoomEnabled: true
		, dblClickZoomEnabled: true
		, mouseWheelZoomEnabled: true
		, preventMouseEventsDefault: true
		, zoomScaleSensitivity: 0.2
		, minZoom: 0.1
		, maxZoom: 10
		, fit: true
		, contain: true
		, center: true
		, refreshRate: 'auto'
		, beforeZoom: function(){}
		, onZoom: function(){}
		, beforePan: function(){}
		, onPan: function(){}
		, eventsListenerElement: null
	});
	
	paper.on('blank:pointerdown', function (evt, x, y) {
		panAndZoom.enablePan();
	});
	paper.on('cell:pointerup blank:pointerup', function(cellView, event) {
		panAndZoom.disablePan();
	});

</script>
<script>
	function updateObjectCoordinates() {
		var positions = {};
		_.each(classes, function(c) {
			positions[c.get('name')] = c.get('position').x+","+c.get('position').y;
		});
		$.post("<?php echo AppSpecificFunctions::getBaseUrl().'/DatabaseManagement/DataModeller/'?>UpdateCoordinates.php", {coords:JSON.stringify(positions)})
			.done(function( data ) {
			
			});
	}
	$('#OutputWrapper').height(window.innerHeight-300);
</script>


<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
