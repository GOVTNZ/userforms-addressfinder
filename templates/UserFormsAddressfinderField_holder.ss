<div id="$Name" class="field<% if $extraClass %> $extraClass<% end_if %>">
	<% if $Title %><label class="left" for="$ID">$Title</label><% end_if %>

	<div class="middleColumn">
	<% if $Message %><span id="{$ID}-error" class="message $MessageType"><i class="fa fa-warning" aria-hidden="true"></i>$Message</span><% end_if %>
		$Field
	</div>
	<% if $RightTitle %><span id="{$Name}_right_title" class="right-title">$RightTitle</span><% end_if %>

	<div role="region" id="addressfinder_live_{$Name}"
		 aria-live="polite"
		 class="addressfinder-live" style="display: none"></div>
</div>
