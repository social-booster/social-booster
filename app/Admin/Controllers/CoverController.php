<?php

namespace App\Admin\Controllers;

use App\Cover;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CoverController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cover';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cover());

        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'))->hide();
        $grid->column('user.name');
        $grid->column('votes', __('Votes'));
        $grid->column('ratio', __('Ratio'));
        $grid->column('upper_concept_id', __('Upper concept id'));
        $grid->column('lower_concept_id', __('Lower concept id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Cover::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('votes', __('Votes'));
        $show->field('ratio', __('Ratio'));
        $show->field('upper_concept_id', __('Upper concept id'));
        $show->field('lower_concept_id', __('Lower concept id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cover());

        $form->text('user_id', __('User id'));
        $form->number('votes', __('Votes'));
        $form->number('ratio', __('Ratio'));
        $form->text('upper_concept_id', __('Upper concept id'));
        $form->text('lower_concept_id', __('Lower concept id'));

        return $form;
    }
}
