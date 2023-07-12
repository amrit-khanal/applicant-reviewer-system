<div class="container">
  <h2>Drug List

    <a href="logout.php" class="pull-right">Logout</a>
  </h2>
  <hr>
  <?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-info"><?php echo $_SESSION['message']; ?></div>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>
  <h4>Pending Drugs:</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($drugLists)) : ?>
        <?php foreach ($drugLists as $drug) : ?>

          <tr>
            <td><?php echo $drug['drug_name']; ?></td>
            <td><?php echo $drug['description']; ?></td>
            <td>
              <?php
              if ($drug['status'] === 'pending') { ?>
                <button class="btn btn-success accept-btn" data-drug-id="<?php echo $drug['id']; ?>" data-action="accept">Accept</button>
                <button class="btn btn-danger reject-btn" data-drug-id="<?php echo $drug['id']; ?>" data-action="reject">Reject</button>
              <?php } else { ?>
                <span class="label <?php if (date(('Y-m-d')) >= $drug['expired_on']) {
                                      echo 'label-warning';
                                    } else {
                                      echo
                                      $drug['status'] === 'approved' ? 'label-success' : 'label-danger';
                                    }
                                    ?>
                ?>"><?= (date(('Y-m-d')) >= $drug['expired_on']) ? 'Expired' : $drug['status']; ?></span>
              <?php } ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="3">No pending drugs found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectionModalLabel">Rejection Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <input type="hidden" name="drugID" id="drugID">
            <div class="form-group">
              <label for="rejectionNote">Note:</label>
              <textarea class="form-control" id="rejectionNote" name="rejectionNote" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $(".accept-btn").on("click", function() {
        var drugID = $(this).data("drug-id");
        var action = $(this).data("action");
        if (confirm("Are you sure you want to " + action + " this drug?")) {
          $.ajax({
            url: "processHandle.php",
            type: "POST",
            data: {
              drugID: drugID,
              action: action
            },
            success: function(response) {
              location.reload();
            }
          });
        }
      });
      $(".reject-btn").on("click", function() {
        let drugId = $(this).data("drug-id");
        $("#drugID").val(drugId);
        $("#rejectionModal").modal("show");
      });

      $("#rejectionModal form").on("submit", function(e) {
        e.preventDefault();
        const drugId = $("#drugID").val();
        const rejectionNote = $("#rejectionNote").val();
        $.ajax({
          url: "processHandle.php",
          type: "POST",
          data: {
            drugID: drugId,
            action: "reject",
            rejectionNote: rejectionNote
          },
          success: function(response) {
            location.reload();
          }
        });
        $("#rejectionModal").modal("hide");
      });
    });
  </script>