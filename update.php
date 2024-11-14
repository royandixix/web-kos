<tbody>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?php echo $row['id_222271']; ?></td>
                                    <td><?php echo $row['nama_222271']; ?></td>
                                    <td><?php echo $row['email_222271']; ?></td>
                                    <td><?php echo $row['no_hp_222271']; ?></td>
                                    <td><?php echo $row['role_222271']; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id_222271']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id_222271']; ?>)">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>