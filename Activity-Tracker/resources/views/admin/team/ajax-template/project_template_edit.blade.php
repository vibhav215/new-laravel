<tr>
    <th>Project Name</th>
    <td>
        <input type="text" name="project_name" readonly disabled class="formcontrol"
            value="{{$project->project_name}}" />
    </td>
</tr>
<tr>
    <th>Project Description</th>
    <td>
        <textarea name="project_description" class="formcontrol" disabled>{{$project->project_description}}</textarea>
    </td>
</tr>
<tr>
    <th>Duration</th>
    <td>
        <input type="text" name="duration" readonly disabled class="formcontrol" value="{{$project->duration}}" />
    </td>
</tr>
<tr>
    <th>Starting from</th>
    <td>
        <input type="text" name="start_time" readonly disabled class="formcontrol" value="{{$project->start_time}}" />
    </td>
</tr>
<tr>
    <th>No of Member(s)</th>
    <td>
        <input type="text" name="team_size" readonly disabled class="formcontrol" value="{{$project->team_size}}" />
    </td>
</tr>
<tr>
    <th>skills</th>
    <td>
        @php
        $skills_Arr = explode(',', $project->skill_set);
        @endphp
        @foreach ($skills_Arr as $skill)
        <span class="badge">{{$skill}}</span>
        @endforeach

    </td>
</tr>
<tr>
    <th>Priority</th>
    <td>
        <input type="text" name="team_size" readonly disabled class="formcontrol" value="{{$project->priority}}" />
    </td>
</tr>
<tr>
    <th>Project status</th>
    <td>
        <input type="text" name="team_size" readonly disabled class="formcontrol" value="{{$project->status}}" />
    </td>
</tr>
<tr>
    <th>Project Progress</th>
    <td>
        @php
        $total = 9;
        $unit = 100 / 9;
        $unitPercentage = sprintf("%.2f", $unit);
        $min = 0;
        $max = 100;
        $statusPercentageArr = [
        'Open' => 1 * $unitPercentage,
        'To Do' => 2 * $unitPercentage,
        'Pending' => 3 * $unitPercentage,
        'In Progress' => 4 * $unitPercentage,
        'Testing' => 5 * $unitPercentage,
        'Deployment' => 6 * $unitPercentage,
        'Suspended' => 7 * $unitPercentage,
        'Delivered' => 8 * $unitPercentage,
        'Closed' => ceil(9 * $unitPercentage)
        ];
        $value = $statusPercentageArr[$project->status];
        @endphp
        {!!$min!!}
        <meter min="0" max="100" class="formcontrol" value="{!!$value!!}" title="{!!$value!!}"></meter>
        {!!$max!!}
    </td>
<tr>
    <th>
        Team Name(*)
    </th>
    <td>
        <input type="text" name="team_name" class="formcontrol" required value="{{$teamName}}" />
    </td>
</tr>
@if ($project->team_size > 0)

<tr>
    <th>Add {{$project->team_size}} Member(s)
    </th>
    <td>
        @for ($i = 0; $i < $project->team_size; $i++)
            <table border="1" style="width:100%">
                <tr>
                    <th>Member {{$i + 1}} :</th>
                    <td>
                        <table style="width:100%">
                            <tr>
                                <td>
                                    <input type="hidden" value="{{$selectedTeam[$i]->id}}" name="teamID[{{$i}}]" />
                                    <select class="formcontrol" name="member[{{$i}}]">
                                        <option>Select Member</option>
                                        @if (count($members) > 0)
                                        @foreach ($members as $user)
                                        <option @if($selectedTeam[$i]->user_id == $user->id) {{"selected"}} @endif
                                            value="{{$user->id}}">
                                            {{$user->name}} ({{$user->email}})
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @php
                                    $memberTypeArr = ['manager','developer','team leader','tester','scrum master']

                                    @endphp
                                    <select class="formcontrol" name="member_type[{{$i}}]">
                                        <option>member type</option>
                                        @if(count($memberTypeArr)>0)
                                        @foreach($memberTypeArr as $memberTypeOption)
                                        <option @if($selectedTeam[$i]->member_type == $memberTypeOption)
                                            {{"selected"}}
                                            @endif
                                            >{{$memberTypeOption}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="formcontrol" name="status[{{$i}}]">
                                        <option>Status</option>
                                        <option value="1" @if($selectedTeam[$i]->is_active == "1") {{"selected"}}
                                            @endif>
                                            Active</option>
                                        <option value="0" @if($selectedTeam[$i]->is_active == "0") {{"selected"}}
                                            @endif>
                                            InActive</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            @endfor
    </td>
</tr>
@endif
</tr>
<tr>
    <td colspan="2">
        <input type="submit" name="submit" class="formcontrol" value="Update" />
    </td>
</tr>