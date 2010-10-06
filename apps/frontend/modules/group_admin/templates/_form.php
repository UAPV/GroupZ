<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php  /* @var $form sfFormSymfony */  ?>

<form action="<?php echo url_for(($form->getObject()->isNew() ? '@group_admin_create' : '@group_admin_update').(!$form->getObject()->isNew() ? '?name='.$form->getObject()->getName() : '')) ?>" method="post" >
  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>


  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
      <?php echo $form->renderGlobalErrors() ?>
    </div>
  <?php endif; ?>

  <script type="text/javascript">
    $(document).ready(function() {

      function cleanGroupName (name) {
        return name.replace (/[^a-z0-9]/ig,'-').toLowerCase ();
      }

      $('#group_title').keyup (function () {
        if(!$('#group_name').data ('overriden'))
        {
          $('#group_name').val (cleanGroupName ($(this).val ()));
        }
      });

      $('#group_name').keyup (function (event) {
        $(this).val (cleanGroupName ($(this).val()));
        $(this).data ('overriden', true);
      });
      
    });
  </script>

  <ul class="fields on-2 columns new_group">
    <li class="column" id="title">
      <?php echo $form['title']->renderLabel() ?>
      <?php echo $form['title']->render() ?>
      <?php echo $form['title']->renderError() ?>
    </li>
    <li class="column" id="name">
      <?php echo $form['name']->renderLabel() ?>
      <?php echo $form['name']->render() ?>
      <span>
        @groupes.univ-avignon.fr <?php // TODO changeme ?>
      </span>
      <?php echo $form['name']->renderError() ?>
    </li>
    <li id="description">
      <?php echo $form['description']->renderLabel() ?>
      <?php echo $form['description']->render() ?>
      <?php echo $form['description']->renderError() ?>
    </li>
    <li id="is_public">
      <?php echo $form['is_public']->render() ?>
      <?php echo $form['is_public']->renderLabel() ?>
    </li>
  </ul>

  <div class="group_members">
    <label><?php echo _('Group members') ?></label>
    <ul class="users">
      <?php foreach ($form->getObject()->getUsers () as $user): ?>
        <li <?php if($user->isGuest()) echo 'class="guest_user"'; ?>
          <?php echo input_hidden_tag ('group[users][]', $user->getId()) ?>
          <span class="user_fullname"><?php echo $user->getFullname (); ?></span>
          <span class="user_email"><?php echo link_to ('mailto:'.$user->getEmail (), $user->getEmail ()) ?></span>
          <span class="user_delete"><a href="#"><?php echo _('Delete') ?></a></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <div id="new_member"">
      <label for="autocomplete_user"><?php echo _('Add user') ?></label>
      <input type="text" id="autocomplete_user" placeholder="<?php echo _('Name or email of your contact') ?>" />
      <input type="submit" id="add_user" value="<?php  echo _('Add') ?>" />

      <script type="text/javascript" src="<?php echo javascript_path('jquery-ui-1.8.5.custom.min.js') ?>" ></script>
      <script type="text/javascript">

        // Initialize the user autocompleter
        $('#autocomplete_user').autocomplete ({
			source: "<?php echo url_for('user/autocomplete') ?>",
			minLength: 2,
            select: selectUser
        })

        // Function called to customize the autocomplete list rendering
        .data("autocomplete")._renderItem = function( ul, item ) {
          return $("<li></li>")
            .data ("item.autocomplete", item)
            .append(
              '<a><span class="user_fullname">'+item.fullname+'</span><br />'+
              '<span class="user_email">'+item.email+'</span>'
            )
            .appendTo (ul);
		};

        // Fonction called when an item is selected in the autocomplete list
        function selectUser ( event, ui ) {
          if (ui.item) // TODO test if user is already in the list
          {
            if (ui.item.id)
              appendUser (ui.item); // user is in the DB
            else
              addUserByEmail (ui.item.email); // user is in the LDAP but not in DB, we need to add him

          }
          else if (this.value)
          {
            addUserByEmail (this.value); // add a guest user
          }
          $(this).val('');
        }

        // Delete user click handler
        $('.user_delete', $('ul.users')).live ('click', function () {
          $(this).closest ('li').remove();
          return false;
        });

        // Add user handler
        $('#add_user').click (function (event) {
          event.preventDefault();
          $('#autocomplete_user').data("autocomplete")._trigger( "select", null, {ui: {}});
        });

        $('#autocomplete_user').keypress (function (event) {
          if (event.keyCode == 13) {
            event.preventDefault();
            $('#add_user').click();
          }
        });

        function addUserByEmail (email)
        {
          $.post('<?php echo url_for ('user/add') ?>', { 'email': email },
            function(data){
              if (data.error)
                alert(data.error);
              else
                appendUser (data);
            }, "json");

        }

        function appendUser (user)
        {
          $('.group_members ul.users').append (
            '<li '+(user.guest ? 'class="guest_user"' : '')+'>'+
              '<input type="hidden" name="group[users][]" value="'+user.id+'"/>'+
              '<span class="user_fullname">'+user.fullname+'</span> '+
              '<span class="user_email"><a href="mailto:'+user.email+'">'+user.email+'</a></span> '+
              '<span class="user_delete"><a href="#"><?php echo _('Delete') ?></a></span>'+
            '</li>');
        }
        
      </script>
      <?php use_stylesheet('jqueryui/jquery-ui-1.8.5.custom.css', sfWebResponse::LAST) ?>
    </div>
  </div>

  <div class="form_actions">
    <input type="submit" value="<?php echo _('Save') ?>" />&nbsp;&nbsp;
    <?php if (!$form->getObject()->isNew()): ?>
      <?php echo link_to(_('Delete'), '@group_admin_delete?name='.$form->getObject()->getName(), array('method' => 'delete', 'confirm' => _('Are you sure?'))) ?>&nbsp;&nbsp;
    <?php endif; ?>
    <a href="<?php echo url_for('group/index') ?>"><?php echo _('Back to list') ?></a>
  </div>

</form>

<div id="dialog-modal" title="<?php echo _('Add a new user') ?>" style="display: none;">
	<p>Adding the modal overlay screen makes the dialog look more prominent because it dims out the page content.</p>
</div>