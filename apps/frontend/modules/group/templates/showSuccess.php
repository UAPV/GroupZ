<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Group->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $Group->getName() ?></td>
    </tr>
    <tr>
      <th>Mailing list name:</th>
      <td><?php echo $Group->getMailingListName() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $Group->getTitle() ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $Group->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $Group->getDescription() ?></td>
    </tr>
    <tr>
      <th>Owner:</th>
      <td><?php echo $Group->getOwnerId() ?></td>
    </tr>
    <tr>
      <th>Expires notice:</th>
      <td><?php echo $Group->getExpiresNotice() ?></td>
    </tr>
    <tr>
      <th>Expires at:</th>
      <td><?php echo $Group->getExpiresAt() ?></td>
    </tr>
    <tr>
      <th>Deleted:</th>
      <td><?php echo $Group->getDeleted() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Group->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Group->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('group/edit?id='.$Group->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('group/index') ?>">List</a>
