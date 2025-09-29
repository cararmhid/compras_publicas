<!-- En tu vista Blade (your_view.blade.php) -->
<div>
{{form::select('tip_comp', $options, null, ['placeholder' => 'Select an option'])}}
</div>