<div class="container">
  <div class="row">
    <!-- Grid column -->
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-body">
          <a href="logout.php" class="pull-right">Logout</a>
          <h3 class="text-center default-text py-3"> Enter Drug Details:</h3>

          <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success"><?php echo $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>
          <form method="POST" action="processHandle.php">
            <input type="hidden" name="action" value="SaveDrug" />
            <div class="form-group">
              <label for="name">Drug Name:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4">
              Save
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>