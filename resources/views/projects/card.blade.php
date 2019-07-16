<div class="card" style="height:200px;">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
        <a href="{{ $project->path() }}">
            {{$project->title}}
        </a>
    </h3>
    <div class="overflow-x-hidden text-grey leading-tight">
        {{ str_limit($project->description, 150) }}
    </div>
</div>