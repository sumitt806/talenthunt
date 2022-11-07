<script id="appliedJobActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.job.notes') ?>" class="btn btn-info action-btn view-note" data-id="{{:id}}" href="#">
            <i class="fas fa-eye"></i>
   </a>
   {{if isJobDrafted}}
   <a title="<?php echo __('messages.job.view_drafted_job') ?>" class="btn btn-warning action-btn" data-id="{{:id}}" href="{{:showUrl}}" target="_blank">
            <i class="fas fa-envelope-open-text"></i>
   </a>
   {{/if}}
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>





</script>
