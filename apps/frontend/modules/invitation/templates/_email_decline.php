
<?php $groupURL = url_for ('@group_show?name='.$invitation->getGroup()->getName(), true) ?>
<?php $member   = (strlen (trim ($invitation->getUser ()->getFullname ())) > 0 ? $invitation->getUser ()->getFullname () : $invitation->getUser ()->getEmail ()) ?>

<?php $title =  __('%member_name% declined your invitation', array (
  '%member_name%' => $member,
  '%group_name%'  => $invitation->getGroup (),
    )) ?>

<?php $message =  __('Unfortunately, %member_name% declined your invitation to join your group "%group_name%"', array (
  '%member_name%' => $member,
  '%group_name%'  => $invitation->getGroup (),
    )) ?>

<?php slot ('email_subject', $title) ?>

<p><?php echo __('Hello %recipient%,', array ('%recipient%' => $recipient->getFirstname ())) ?></p>

<p><?php echo $message ?>.</p>

<p><?php echo $invitation->getGroup().' : '.link_to ($groupURL, $groupURL) ?></p>