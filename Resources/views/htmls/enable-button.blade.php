<input type="checkbox" data-toggle="toggle" data-size="{{ $size }}" data-onstyle="{{ $on ?? 'success' }}"
       data-offstyle="{{ $off ?? 'danger' }}" data-model="" data-field="enabled" data-id="{{}}"
       data-on="<i class='mdi mdi-check-bold fw-bolder'></i> Yes"
       data-off="<i class='mdi mdi-close fw-bolder'></i> No"
       @if($permission->enabled == 'yes') checked @endif>
