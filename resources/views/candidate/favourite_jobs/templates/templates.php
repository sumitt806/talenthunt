<script id="favouriteJobsActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>



</script>

<script id="jobStatusActionTemplate" type="text/x-jsrender">
 {{if status == '1'}}
<button class="btn btn-success mr-1 badge job-application-status"><?php echo __('messages.common.live') ?></button>
{{else status == '2'}}
<button class="btn btn-danger mr-1 badge job-application-status"><?php echo __('messages.common.close') ?></button>
 {{else status == '3'}}
<button class="btn btn-primary mr-1 badge job-application-status"><?php echo __('messages.common.pause') ?></button>
 {{/if}}


</script>
