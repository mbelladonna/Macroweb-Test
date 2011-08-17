<?php
class Controller_Answers extends Controller_Template {
	
	public function action_index()
	{
		$data['answers'] = Model_Answer::find('all');
		$this->template->title = "Answers";
		$this->template->content = View::factory('answers/index', $data);

	}
	
	public function action_view($id = null)
	{
		$data['answer'] = Model_Answer::find($id);
		
		$this->template->title = "Answer";
		$this->template->content = View::factory('answers/view', $data);

	}
	
	public function action_create($id = null, $ask_id=null)
	{
		if (Input::method() == 'POST')
		{
			$answer = Model_Answer::factory(array(
				'question_id' => Input::post('question_id'),
				'ask_id' => Input::post('ask_id'),
				'answer' => Input::post('answer'),
				'points' => Input::post('points'),
				'is_correct' => Input::post('is_correct'),
			));

			if ($answer and $answer->save())
			{
				Session::set_flash('notice', 'Added answer #' . $answer->id . '.');

				Response::redirect('answers');
			}

			else
			{
				Session::set_flash('notice', 'Could not save answer.');
			}
		}

		$this->template->title = "Answers";
		$this->template->content = View::factory('answers/create', array('question_id' => $id, 'ask_id' => $ask_id));

	}
	
	public function action_edit($id = null)
	{
		$answer = Model_Answer::find($id);

		if (Input::method() == 'POST')
		{
			$answer->question_id = Input::post('question_id');
			$answer->ask_id = Input::post('ask_id');
			$answer->answer = Input::post('answer');
			$answer->points = Input::post('points');
			$answer->is_correct = Input::post('is_correct');

			if ($answer->save())
			{
				Session::set_flash('notice', 'Updated answer #' . $id);

				Response::redirect('answers');
			}

			else
			{
				Session::set_flash('notice', 'Could not update answer #' . $id);
			}
		}
		
		else
		{
			$this->template->set_global('answer', $answer, false);
		}
		
		$this->template->title = "Answers";
		$this->template->content = View::factory('answers/edit');

	}
	
	public function action_delete($id = null)
	{
		if ($answer = Model_Answer::find($id))
		{
			$answer->delete();
			
			Session::set_flash('notice', 'Deleted answer #' . $id);
		}

		else
		{
			Session::set_flash('notice', 'Could not delete answer #' . $id);
		}

		Response::redirect('answers');

	}
	
	
}

/* End of file answers.php */
