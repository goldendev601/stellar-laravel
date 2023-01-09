<div class="dropdown p-0 me-0">
    <p class="mb-0 text-center" data-bs-toggle="dropdown" aria-expanded="false"><i
            style="color:#4D5997 !important;cursor:pointer" data-feather="more-vertical"><img
                src="{{ asset('assets/images/more-vertical.svg') }}" alt=""></i>
    </p>
    <ul class="dropdown-menu" style="color:#4D5997 !important">
        <li><a href="{{ route('members.edit', $id) }}" class="dropdown-item d-flex align-items-center font-loto"><i
                    data-feather="user"></i><span class="ms-1 text-default">
                    Edit </span></a></li>
        @if ($member_status_id == 1)
        <li><a href="{{ route('conversations_index', $id) }}" class="dropdown-item d-flex align-items-center font-loto"><i
                    data-feather="message-square"></i><span class="ms-1 text-default">View Conversation</span></a>
        @endif
        </li>
        <li>
            @if ($member_status_id == 1)
                <a href="javascript:void(0)" class="dropdown-item status_change d-flex align-items-center font-loto"
                    data-id="{{ $id }}" data-status="2"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Archived</span></a>
                <a href="javascript:void(0)" class="dropdown-item d-flex status_change align-items-center font-loto"
                    data-id="{{ $id }}" data-status="3"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Wait list</span></a>
            @endif
            @if ($member_status_id == 2)
                <a href="javascript:void(0)" class="dropdown-item status_change d-flex align-items-center font-loto"
                    data-id="{{ $id }}" data-status="1"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Active</span></a>
                <a href="javascript:void(0)" class="dropdown-item d-flex status_change align-items-center font-loto"
                    data-id="{{ $id }}" data-status="3"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Wait list</span></a>
            @endif
            @if ($member_status_id == 3)
                <a href="javascript:void(0)" class="dropdown-item status_change d-flex align-items-center font-loto"
                    data-id="{{ $id }}" data-status="2"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Archived</span></a>
                <a href="javascript:void(0)" class="dropdown-item status_change d-flex align-items-center font-loto"
                    data-id="{{ $id }}" data-status="1"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">Active</span></a>
            @endif

        </li>
    </ul>
</div>
