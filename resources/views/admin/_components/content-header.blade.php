<?php
$breadcrumb = [
    'home' => [
        'url' => route('admin.dashboard'),
        'content' => 'Home',
        'icon' => 'home',
    ],
    'users.index' => [
        'url' => route('admin.users.index'),
        'content' => 'Pengguna',
        'icon' => 'users',
    ],
    'users.add' => [
        'url' => '#',
        'content' => 'Tambah',
    ],
    'users.edit' => [
        'url' => '#',
        'content' => 'Edit',
    ],
    'user-groups.index' => [
        'url' => route('admin.users.index'),
        'content' => 'Grup Pengguna',
        'icon' => 'users',
    ],
    'user-groups.add' => [
        'url' => '#',
        'content' => 'Tambah',
    ],
    'user-groups.edit' => [
        'url' => '#',
        'content' => 'Edit',
    ],
    'fields.index' => [
        'url' => route('admin.fields.index'),
        'content' => 'Lapangan',
        'icon' => 'vector-square',
    ],
    'fields.add' => [
        'content' => 'Tambah',
    ],
    'fields.edit' => [
        'content' => 'Edit',
    ],
];
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $title }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @if (!empty($breadcrumbItems))
            @for ($i = 0; $i < count($breadcrumbItems) - 1; $i++)
              <li class="breadcrumb-item">
                <a href="{{ $breadcrumb[$breadcrumbItems[$i]]['url'] }}">
                  @if (isset($breadcrumb[$breadcrumbItems[$i]]['icon']))
                    <i class="fa fa-{{ $breadcrumb[$breadcrumbItems[$i]]['icon'] }}"></i>
                  @endif
                  {{ $breadcrumb[$breadcrumbItems[$i]]['content'] }}
                </a>
              </li>
            @endfor
            <li class="breadcrumb-item">
              @if (isset($breadcrumb[$breadcrumbItems[count($breadcrumbItems) - 1]]['icon']))
                <i class="fa fa-{{ $breadcrumb[$breadcrumbItems[$i]]['icon'] }}"></i>
              @endif
              {{ $breadcrumb[$breadcrumbItems[count($breadcrumbItems) - 1]]['content'] }}
            </li>
          @endif
        </ol>
      </div>
    </div>
  </div>
</section>
