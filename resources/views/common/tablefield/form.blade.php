<div class="box-body">
    <div class="col-md-12">
        <table class="table table-border">
            <tr>
                <td>Field Name</td>
                <td>Field Type</td>
                <td>Default Value</td>
                <td>Is Nullable</td>
                <td>Is Primary</td>
                <td>Is Index</td>
                <td>Is Unique</td>
                <td>Is Soft Delete</td>
                <td>Action</td>
            </tr>
            <tbody id="tableBody">
                <tr id="first">
                    <td>
                        <input type="text" name="field_name[]" class="form-control" />
                    </td>
                    <td>
                        <select name="field_type[]" class="form-control">
                            <option value="int">Integer</option>
                            <option value="float">Float</option>
                            <option value="string">String</option>
                            <option value="date">Date</option>
                            <option value="datetime">Date Time</option>
                            <option value="timestamp">Time Stamp</option>
                            <option value="longText">Long Text</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="default_value[]" class="form-control" />
                    </td>
                    <td>
                        <select name="is_nullable[]" class="form-control">
                            <option selected="selected" value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_primary_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_index_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_unique_field[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select name="is_soft_delete[]" class="form-control">
                            <option selected="selected" value="0">No</option>
                            <option  value="1">Yes</option>
                        </select>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary addItem">+</a>
                        <!-- <button class="btn btn-sm btn-danger remove">Remove</button> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
