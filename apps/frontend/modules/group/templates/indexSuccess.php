<h1>Groups List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Mailing list name</th>
      <th>Title</th>
      <th>Is public</th>
      <th>Description</th>
      <th>Owner</th>
      <th>Expires notice</th>
      <th>Expires at</th>
      <th>Deleted</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Groups as $Group): ?>
    <tr>
      <td><a href="<?php echo url_for('group/show?id='.$Group->getId()) ?>"><?php echo $Group->getId() ?></a></td>
      <td><?php echo $Group->getName() ?></td>
      <td><?php echo $Group->getMailingListName() ?></td>
      <td><?php echo $Group->getTitle() ?></td>
      <td><?php echo $Group->getIsPublic() ?></td>
      <td><?php echo $Group->getDescription() ?></td>
      <td><?php echo $Group->getOwnerId() ?></td>
      <td><?php echo $Group->getExpiresNotice() ?></td>
      <td><?php echo $Group->getExpiresAt() ?></td>
      <td><?php echo $Group->getDeleted() ?></td>
      <td><?php echo $Group->getCreatedAt() ?></td>
      <td><?php echo $Group->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('group/new') ?>">New</a>
