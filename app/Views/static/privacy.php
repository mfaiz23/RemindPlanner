<?= $this->extend('templates/auth/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Privacy Policy</h3>
                </div>
                <div class="card-body">
                    <div class="content">
                        <p class="text-muted">Last updated: <?= date('F d, Y') ?></p>

                        <h4>1. Introduction</h4>
                        <p>At RemindPlanner, we respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.</p>

                        <h4>2. Information We Collect</h4>
                        <p>We collect several different types of information for various purposes to provide and improve our Service to you:</p>
                        <ul>
                            <li><strong>Personal Data:</strong> Name, email address, phone number</li>
                            <li><strong>Usage Data:</strong> Browser type, access time, pages viewed</li>
                            <li><strong>Task Data:</strong> Task details, reminders, and categories you create</li>
                        </ul>

                        <h4>3. How We Use Your Information</h4>
                        <p>We use the collected data for various purposes:</p>
                        <ul>
                            <li>To provide and maintain our Service</li>
                            <li>To notify you about changes to our Service</li>
                            <li>To provide customer support</li>
                            <li>To gather analysis or valuable information to improve our Service</li>
                            <li>To monitor the usage of our Service</li>
                            <li>To detect, prevent and address technical issues</li>
                        </ul>

                        <h4>4. Data Security</h4>
                        <p>The security of your data is important to us. We implement appropriate security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information.</p>

                        <h4>5. Data Retention</h4>
                        <p>We will retain your personal data only for as long as necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, accounting, or reporting requirements.</p>

                        <h4>6. Your Data Protection Rights</h4>
                        <p>You have the following data protection rights:</p>
                        <ul>
                            <li>The right to access your personal data</li>
                            <li>The right to update or correct your personal data</li>
                            <li>The right to delete your personal data</li>
                            <li>The right to restrict processing of your personal data</li>
                            <li>The right to object to processing of your personal data</li>
                            <li>The right to data portability</li>
                        </ul>

                        <h4>7. Cookies</h4>
                        <p>We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

                        <h4>8. Third-Party Services</h4>
                        <p>We may employ third-party companies and individuals to facilitate our Service, provide the Service on our behalf, perform Service-related services, or assist us in analyzing how our Service is used.</p>

                        <h4>9. Children's Privacy</h4>
                        <p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13.</p>

                        <h4>10. Changes to This Privacy Policy</h4>
                        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "last updated" date.</p>

                        <h4>Contact Us</h4>
                        <p>If you have any questions about this Privacy Policy, please contact us at privacy@remindplanner.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
