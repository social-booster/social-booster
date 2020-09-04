<?php

namespace App\Admin\Controllers;

use App\ConceptVote;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConceptVoteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ConceptVote';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ConceptVote());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'))->hide();
        $grid->column('user.name');
        $grid->column('value', __('Value'));
        $grid->column('concept_id', __('Concept id'));
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
        $show = new Show(ConceptVote::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('value', __('Value'));
        $show->field('concept_id', __('Concept id'));
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
        $form = new Form(new ConceptVote());

        $form->text('user_id', __('User id'));
        $form->number('value', __('Value'));
        $form->text('concept_id', __('Concept id'));

        return $form;
    }
}
