<!DOCTYPE html>
<html>
<head>
    <title>Task Reminder</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 10px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; font-size: 0.8em; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Task Reminder</h2>
        </div>
        
        <div class="content">
            <p>Hi <?= $user_name ?>,</p>
            
            <p>This is a reminder about your task:</p>
            
            <h3><?= $task_title ?></h3>
            
            <p><strong>Due Date:</strong> <?= date('l, F j, Y', strtotime($due_date)) ?> 
            (in <?= $days_left ?> day<?= $days_left > 1 ? 's' : '' ?>)</p>
            
            <?php if(!empty($description)): ?>
            <p><strong>Description:</strong><br>
            <?= nl2br($description) ?></p>
            <?php endif; ?>
            
            <p>Please complete your task on time!</p>
        </div>
        
        <div class="footer">
            <p>This is an automated reminder from Remind Planner System.</p>
        </div>
    </div>
</body>
</html>