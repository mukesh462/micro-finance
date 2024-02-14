<style>
    
</style>
<div class="container d-flex justify-content-center align-items-center">

<div id="form-container">
  <div class="form-row">
    <div class="col-12 col-md-6 col-lg-6">
            <select type="text" class="member-select form-control" placeholder="Select Member">
        <option>sdsd</option>
    </select>
    </div>

    <input type="text" class="plan-select" placeholder="Select Plan">
    <input type="text" class="purpose-field" placeholder="Enter Purpose">
    <input type="text" class="employee-select" placeholder="Select Employee">
    <button class="remove-btn">Remove</button>
  </div>
</div>

<button id="add-btn">Add</button>

<table id="data-table">
  <thead>
    <tr>
      <th>Member</th>
      <th>Plan</th>
      <th>Purpose</th>
      <th>Employee</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="table-body">
    <!-- Table body content will be inserted dynamically -->
  </tbody>
</table>




</div>

<script>
    $(document).ready(function() {

    
  // Add button click event
  $('#add-btn').click(function() {
    var member = $('.member-select').val();
    var plan = $('.plan-select').val();
    var purpose = $('.purpose-field').val();
    var employee = $('.employee-select').val();

    var newRow = '<tr>' +
      '<td>' + member + '</td>' +
      '<td>' + plan + '</td>' +
      '<td>' + purpose + '</td>' +
      '<td>' + employee + '</td>' +
      '<td><button class="remove-btn">Remove</button></td>' +
      '</tr>';

    $('#table-body').append(newRow);

    // Clear input fields
    $('.member-select').val('');
    $('.plan-select').val('');
    $('.purpose-field').val('');
    $('.employee-select').val('');
  });

  // Remove button click event
  $('#data-table').on('click', '.remove-btn', function() {
    $(this).closest('tr').remove(); // Remove the closest table row
  });
});

</script>