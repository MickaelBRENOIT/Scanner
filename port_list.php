<?php
    include_once("header.php");
?>

<!-- Modal add port -->
<div class="modal fade" id="addPortModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignUpModalLabel">Create a port</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="sr-only" for="add-portname-group">Port</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Port&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  </div>
                        <input type="text" class="form-control" id="add-portname-group" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="add-type-group">Type</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Port Type &nbsp;&nbsp;&nbsp;</div>
							<select class="custom-select w-100" id="add-type-group">
								<option value="TCP">TCP</option>
								<option value="UDP">UDP</option>
							</select>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="add-keyword-group">Keyword</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Keyword&nbsp; &nbsp; &nbsp; </div>
                        <input type="text" class="form-control" id="add-keyword-group" required>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="add-description-group">Description</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Description</div>
                        <input type="text" class="form-control" id="add-description-group" required>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="add-virus-group">Virus</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Virus &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
                        <input type="text" class="form-control" id="add-virus-group" required>
                    </div>
                </div>
                <div class="alert alert-danger text-center" role="alert" id="add-port-errors-display"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addAPort">Add an port</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal delete port -->
<div class="modal fade" id="DeletePortModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignUpModalLabel">Delete a port</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning text-center" role="alert" id="delete-port-display"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="DeleteAnPort">Delete the port</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal update port -->
<div class="modal fade" id="updatePortModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignUpModalLabel">Update a port</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<input type="hidden" id="modify-id-group" value="">
                <div class="form-group">
                    <label class="sr-only" for="modify-portname-group">Port</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Port&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  </div>
                        <input type="text" class="form-control" id="modify-portname-group" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="modify-type-group">Type</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Port Type &nbsp;&nbsp;&nbsp;</div>
							<select class="custom-select w-100" id="modify-type-group">
								<option value="TCP">TCP</option>
								<option value="UDP">UDP</option>
							</select>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="modify-keyword-group">Keyword</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Keyword&nbsp; &nbsp; &nbsp; </div>
                        <input type="text" class="form-control" id="modify-keyword-group" required>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="modify-description-group">Description</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Description</div>
                        <input type="text" class="form-control" id="modify-description-group" required>
                    </div>
                </div>
				<div class="form-group">
                    <label class="sr-only" for="modify-virus-group">Virus</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Virus &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
                        <input type="text" class="form-control" id="modify-virus-group" required>
                    </div>
                </div>
                <div class="alert alert-danger text-center" role="alert" id="modify-errors-display"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="ModifyAPort">Modify a port</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for xml import -->
<div class="modal fade" id="importXmlModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignUpModalLabel">Import XML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<form action="importXML.php" method="post" enctype="multipart/form-data">
				<div class="modal-body">
				
					<h2>Upload File</h2>
					<label for="fileSelect">Filename:</label>
					<input type="file" name="xml" id="fileSelect">
					
				
				</div>
				<div class="modal-footer">
					<div class="fileupload-buttonbar">
							<input type="submit" name="submit" value="Upload" class="btn btn-success start">
                    </div>
				</div>
			</form>
        </div>
    </div>
</div>

<!-- Modal for xml export -->
<div class="modal fade" id="ExportXmlModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignUpModalLabel">Export ports database into XML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning text-center" role="alert" id="export-xml-display"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<form method="get" action="upload/exported.xml">
					<a class="btn btn-danger" href="upload/exported.xml" download>Export</a>
				</form>
                
            </div>
        </div>
    </div>
</div>






<div class="container mt-3 mb-3">
    <div class="text-center">
        <h1>Port List</h1>
    </div>
</div>

<hr style="display: block; margin-top: 0.5em; margin-bottom: 0.5em; margin-left: auto; margin-right: auto; border-style: inset; border-width: 1px;">
<div class="container mt-3 mb-3">
    <div class="text-center">
        <button class="btn btn-success" id="add-port">Add a port</button>
        <button class="btn btn-primary" id="display-port-list">Display all ports</button>
		<button class="btn btn-success" id="display-xml-import">Import port through XML file</button>
		<button class="btn btn-primary" id="display-xml-export">Export port database into an XML file</button>
    </div>
</div>

<div id="table-ports" class="container"> 
</div>

<?php
    include_once("footer.php");
?>