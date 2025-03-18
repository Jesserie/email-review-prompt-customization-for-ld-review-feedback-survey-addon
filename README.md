# LearnDash Ratings, Reviews, & Feedback - Course Review Prompt Customization

This repository contains a custom function for the **Ratings, Reviews, & Feedback** add-on for LearnDash that modifies the behavior of course review prompts. By default, LearnDash sends review prompts when users complete lessons, topics, quizzes, or update their course access. This function removes those prompts and ensures review requests are only sent when the course is fully completed.

## Functionality

- Removes review prompt triggers for:
  - Lesson completion
  - Topic completion
  - Quiz completion
  - Course access updates

- Ensures review prompts are only sent when the entire course has been completed.

## Installation

You can add this function in one of the following ways:

### Option 1: Add to `functions.php`

1. Open your WordPress theme's `functions.php` file.
2. Copy the following code and paste it at the end of the file:

```php
function only_course_completed_review_prompt() {
    if ( class_exists( 'ns_wdm_ld_course_review\Review_Prompt_Email' ) ) {
        $class_instance = ns_wdm_ld_course_review\Review_Prompt_Email::get_instance();

        // Remove actions for lesson, topic, quiz completion, and course access updates.
        remove_action( 'learndash_lesson_completed', array( $class_instance, 'check_if_review_prompt_mail_criteria_met' ), 5, 1 );
        remove_action( 'learndash_topic_completed', array( $class_instance, 'check_if_review_prompt_mail_criteria_met' ), 5, 1 );
        remove_action( 'learndash_quiz_completed', array( $class_instance, 'handle_review_criteria_separately_on_quiz' ), 5, 2 );
        remove_action( 'learndash_update_course_access', array( $class_instance, 'handle_review_criteria_separately_on_enrollment' ), 5, 4 );
    }
}
add_action( 'init', 'only_course_completed_review_prompt', 100 );
```

3. Save the file.
   
Option 2: Use a Snippet Plugin
If you prefer not to modify your functions.php file directly, you can use a snippet plugin like Code Snippets to add the code.
Install and activate the Code Snippets plugin.
- Go to Snippets > Add New in your WordPress dashboard.
- Copy the code provided above and paste it into the snippet editor.
- Save and activate the snippet.
