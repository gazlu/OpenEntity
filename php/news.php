<?php
	$pageTitle = 'News';
	include_once('header.php');
	include_once('utils/htmlutils.php');
?>
<body>

<h2>
	Track and Trace Content Management
</h2>
<div id="stylized" class="myform">

<div id="container">
	<h1>
		Manage News
	</h1>
		<div id="genMsg" style="color:#FF0000; font-weight:bold;padding:8px; text-align:center"></div>
		<form class="basic" action="repo/newsrepo.php" method="post" onSubmit="return subCommonForm(0, 'main')" name="dataform" id="dataform" enctype="multipart/form-data">
			<div class="inner-form">
				<dl>
					<dt><label for="newstitle">News Title:</label></dt>
					<dd>
						<input type="hidden" id="id" name="id" value="0"/>
						<input type="text" req="true" name="newstitle" valsection="main" id="newstitle"/>
						<small>Title of the news</small>
					</dd>
					
					<dt><label for="advDate">News Cotents:</label></dt>
					<dd>
						<textarea name="newsHtml" id="newsHtml" req="true" valsection="main"></textarea>
						<small>Content for the news (Html is also applicable)</small>
					</dd>
					
					<dt><label for="expAmount">News Date:</label></dt>
					<dd>
						<input type="text" req="true" class="txt" id="newsDate" value="" valdata="date" name="newsDate" valsection="main" />
						<small>News Publishing Date</small>
					</dd>
					<dt><label for="expAmount">News Till Date:</label></dt>
					<dd>
						<input type="text" req="true" class="txt" id="newsTillDate" value="" valdata="date" name="newsTillDate" valsection="main" />
						<small>Date till news should be visible</small>
					</dd>
					<dd style="width:90%; text-align:right;">
						<input class="button" type="submit" value="Save" />
						<input class="button altbutton" type="reset" onClick="refreshParent();" value="Cancel" />
					</dd>
				</dl>
			</div>
		</form>
	</div>
	<div>
		<table cellpadding="0" cellspacing="0" border="0" class="display gtable sortable" id="datatable">
			<thead>
				<tr>
					<th width="20%">
						Title
					</th>
					<th width="20%">
						Contents
					</th>
					<th width="20%">
						News Date
					</th>
					<th width="20%">
						Valid Till
					</th>
					<th width="20%">
						Actions
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					echo HtmlUtils::DataTableRows('AllNews', 'newstitle,newsHtml,newsDate,newsTillDate');
				?>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
</div>
</div>
</body>