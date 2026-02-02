<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You for Contacting Us</title>
        <style>
                * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                }

                body {
                        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                        background-color: #f3f4f6;
                        padding: 20px;
                        margin: 0;
                }

                .container {
                        max-width: 100%;
                        width: 600px;
                        margin: 0 auto;
                        background: white;
                        border-radius: 16px;
                        overflow: hidden;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                /* Mobile Responsive */
                @media only screen and (max-width: 600px) {
                        .container {
                                width: 100% !important;
                                border-radius: 0;
                        }

                        body {
                                padding: 0;
                        }
                }

                .header {
                        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                        padding: 40px 30px;
                        text-align: center;
                        color: white;
                }

                .header h1 {
                        font-size: 28px;
                        margin-bottom: 10px;
                        font-weight: 700;
                }

                .header p {
                        font-size: 16px;
                        opacity: 0.95;
                }

                .content {
                        padding: 40px 30px;
                }

                @media only screen and (max-width: 600px) {
                        .content {
                                padding: 20px 15px;
                        }
                }

                .greeting {
                        font-size: 18px;
                        color: #1f2937;
                        margin-bottom: 20px;
                }

                .message-box {
                        background: #eff6ff;
                        border-left: 4px solid #3b82f6;
                        padding: 20px;
                        border-radius: 8px;
                        margin: 25px 0;
                }

                .message-box h3 {
                        color: #1e40af;
                        font-size: 16px;
                        margin-bottom: 15px;
                }

                .info-row {
                        display: flex;
                        padding: 12px 0;
                        border-bottom: 1px solid #e5e7eb;
                        gap: 10px;
                }

                .info-row:last-child {
                        border-bottom: none;
                }

                .info-label {
                        font-weight: 600;
                        color: #374151;
                        min-width: 100px;
                        flex-shrink: 0;
                }

                .info-value {
                        color: #6b7280;
                        flex: 1;
                        word-wrap: break-word;
                        overflow-wrap: break-word;
                }

                .message-text {
                        background: #f9fafb;
                        padding: 15px;
                        border-radius: 6px;
                        color: #4b5563;
                        line-height: 1.6;
                        margin-top: 10px;
                        word-wrap: break-word;
                        overflow-wrap: break-word;
                }

                .next-steps {
                        background: #f0fdf4;
                        border: 1px solid #86efac;
                        border-radius: 8px;
                        padding: 20px;
                        margin: 25px 0;
                }

                .next-steps h4 {
                        color: #166534;
                        font-size: 16px;
                        margin-bottom: 12px;
                }

                .next-steps ul {
                        list-style: none;
                        padding-left: 0;
                }

                .next-steps li {
                        color: #15803d;
                        padding: 8px 0;
                        padding-left: 25px;
                        position: relative;
                }

                .next-steps li:before {
                        content: "✓";
                        position: absolute;
                        left: 0;
                        color: #22c55e;
                        font-weight: bold;
                }

                .social-links {
                        text-align: center;
                        padding: 25px 0;
                        border-top: 1px solid #e5e7eb;
                        margin-top: 30px;
                }

                .social-links p {
                        color: #6b7280;
                        margin-bottom: 15px;
                }

                .social-icons {
                        text-align: center;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                }

                .social-icons a {
                        display: inline-flex;
                        width: 40px;
                        height: 40px;
                        background: #3b82f6;
                        border-radius: 50%;
                        text-decoration: none;
                        color: white;
                        align-items: center;
                        justify-content: center;
                        transition: transform 0.3s;
                }

                .social-icons a img {
                        width: 20px;
                        height: 20px;
                        filter: brightness(0) invert(1);
                }

                .social-icons a:hover {
                        transform: translateY(-3px);
                        background: #2563eb;
                }

                .footer {
                        background: #f9fafb;
                        padding: 30px;
                        text-align: center;
                        color: #6b7280;
                        font-size: 14px;
                }

                .footer p {
                        margin: 5px 0;
                }

                .badge {
                        display: inline-block;
                        background: #3b82f6;
                        color: white;
                        padding: 6px 12px;
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: 600;
                        margin-top: 10px;
                }
        </style>
</head>

<body>
        <div class="container">
                <!-- Header -->
                <div class="header">
                        <h1>✉️ Thank You for Reaching Out!</h1>
                        <p>We've received your message successfully</p>
                </div>

                <!-- Content -->
                <div class="content">
                        <p class="greeting">Hi <strong>{{ $contactMessage->name }}</strong>,</p>

                        <p style="color: #4b5563; line-height: 1.6; margin-bottom: 20px;">
                                Thank you for contacting me! I've received your message and appreciate you taking the time to reach out.
                                I'll review your message and get back to you as soon as possible.
                        </p>

                        <!-- Message Summary -->
                        <div class="message-box">
                                <h3>📋 Your Message Details</h3>

                                <div class="info-row">
                                        <span class="info-label">Name:</span>
                                        <span class="info-value">{{ $contactMessage->name }}</span>
                                </div>

                                <div class="info-row">
                                        <span class="info-label">Email:</span>
                                        <span class="info-value">{{ $contactMessage->email }}</span>
                                </div>

                                @if($contactMessage->phone)
                                <div class="info-row">
                                        <span class="info-label">Phone:</span>
                                        <span class="info-value">{{ $contactMessage->phone }}</span>
                                </div>
                                @endif

                                <div class="info-row">
                                        <span class="info-label">Subject:</span>
                                        <span class="info-value">{{ $contactMessage->subject }}</span>
                                </div>

                                <div style="margin-top: 15px;">
                                        <span class="info-label">Message:</span>
                                        <div class="message-text">{{ $contactMessage->message }}</div>
                                </div>
                        </div>

                        <!-- Next Steps -->
                        <div class="next-steps">
                                <h4>🚀 What Happens Next?</h4>
                                <ul>
                                        <li>I'll review your message carefully</li>
                                        <li>You'll hear back from me within 24-48 hours</li>
                                        <li>Keep an eye on your inbox for my response</li>
                                </ul>
                        </div>

                        <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
                                <strong>Note:</strong> This is an automated confirmation email. Please do not reply to this email.
                        </p>

                        <!-- Social Links -->
                        <!-- <div class="social-links">
                                <p>Connect with me on social media:</p>
                                <div class="social-icons">
                                        <a href="https://github.com/bhaskarbisht" title="GitHub">
                                                G
                                        </a>
                                        <a href="https://linkedin.com/in/bhaskarbisht" title="LinkedIn">
                                                L
                                        </a>
                                        <a href="https://twitter.com/bhaskarbisht" title="Twitter">
                                                X
                                        </a>
                                </div>
                        </div> -->
                </div>

                <!-- Footer -->
                <div class="footer">
                        <p><strong>Bhaskar Bisht</strong></p>
                        <p>Full Stack Developer</p>
                        <p style="margin-top: 10px;">📧 bhaskar.s.bist@gmail.com</p>
                        <p>📍 Delhi, India</p>
                        <span class="badge">Available for Work</span>
                        <p style="margin-top: 20px; font-size: 12px; color: #9ca3af;">
                                © {{ date('Y') }} Bhaskar Bisht. All rights reserved.
                        </p>
                </div>
        </div>
</body>

</html>