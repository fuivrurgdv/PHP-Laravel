<style>
    /* Cải thiện giao diện tree view */
    .tree-node {
        display: flex;
        align-items: center;
        padding: 5px;
        margin: 5px 0;
        cursor: pointer;
    }

    .tree-node .toggle-btn {
        margin-right: 8px;
        background: none;
        border: none;
        font-size: 16px;
        color: #888;
        cursor: pointer;
    }

    .tree-node .department-name {
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    /* Ẩn sub-tree ban đầu */
    .sub-tree {
        margin-left: 20px;
        display: none;
    }
</style>

<div class="tree-node">
    <button class="toggle-btn" onclick="toggleSubTree({{ $department->id }})">
        <i id="icon-{{ $department->id }}" class="fas fa-chevron-down"></i>
    </button>
    <a href="{{ route('departments.show', $department->id) }}" class="department-name">
        {{ $department->name }} ({{ $department->children->count() }})
    </a>
</div>

<div id="sub-tree-{{ $department->id }}" class="sub-tree">
    @foreach ($department->children as $child)
        @include('fe_department.department_tree', ['department' => $child])
    @endforeach
</div>

<script>
    // JavaScript để toggle sub-tree
    function toggleSubTree(departmentId) {
        const subTree = document.getElementById(`sub-tree-${departmentId}`);
        const icon = document.getElementById(`icon-${departmentId}`);
        
        // Kiểm tra và thay đổi trạng thái hiển thị của sub-tree
        if (subTree.style.display === 'none' || subTree.style.display === '') {
            subTree.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            subTree.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>
