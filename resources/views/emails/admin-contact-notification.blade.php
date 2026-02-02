<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Contact Form Submission</title>
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
                        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
                        padding: 40px 30px;
                        text-align: center;
                        color: white;
                }

                .header h1 {
                        font-size: 28px;
                        margin-bottom: 10px;
                        font-weight: 700;
                }

                .header .badge {
                        display: inline-block;
                        background: rgba(255, 255, 255, 0.2);
                        padding: 8px 16px;
                        border-radius: 20px;
                        font-size: 14px;
                        margin-top: 10px;
                }

                .content {
                        padding: 40px 30px;
                }

                @media only screen and (max-width: 600px) {
                        .content {
                                padding: 20px 15px;
                        }
                }

                .alert {
                        background: #fef3c7;
                        border-left: 4px solid #f59e0b;
                        padding: 15px 20px;
                        border-radius: 8px;
                        margin-bottom: 25px;
                        color: #92400e;
                }

                .user-info {
                        background: #eff6ff;
                        border-radius: 12px;
                        padding: 25px;
                        margin: 25px 0;
                }

                .user-info h3 {
                        color: #1e40af;
                        font-size: 18px;
                        margin-bottom: 20px;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                }

                .info-grid {
                        display: grid;
                        gap: 15px;
                }

                .info-item {
                        display: flex;
                        padding: 12px;
                        background: white;
                        border-radius: 8px;
                        border-left: 3px solid #3b82f6;
                        gap: 10px;
                        margin-bottom: 10px;
                }

                .info-label {
                        font-weight: 600;
                        color: #374151;
                        min-width: 120px;
                        font-size: 14px;
                        flex-shrink: 0;
                }

                .info-value {
                        color: #1f2937;
                        flex: 1;
                        font-size: 14px;
                        word-wrap: break-word;
                        overflow-wrap: break-word;
                }

                .message-section {
                        background: #f9fafb;
                        border-radius: 12px;
                        padding: 20px;
                        margin: 25px 0;
                }

                .message-section h4 {
                        color: #374151;
                        font-size: 16px;
                        margin-bottom: 15px;
                }

                .message-content {
                        background: white;
                        padding: 20px;
                        border-radius: 8px;
                        color: #4b5563;
                        line-height: 1.8;
                        border: 1px solid #e5e7eb;
                        font-size: 15px;
                        word-wrap: break-word;
                        overflow-wrap: break-word;
                }

                .meta-info {
                        background: #f0f9ff;
                        border-radius: 8px;
                        padding: 20px;
                        margin: 25px 0;
                }

                .meta-info h4 {
                        color: #075985;
                        font-size: 14px;
                        margin-bottom: 12px;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                }

                .meta-item {
                        padding: 8px 0;
                        color: #0c4a6e;
                        font-size: 13px;
                        display: flex;
                        gap: 10px;
                }

                .meta-item strong {
                        min-width: 100px;
                        flex-shrink: 0;
                }

                .action-buttons {
                        text-align: center;
                        padding: 30px 0;
                }

                .btn {
                        display: inline-block;
                        padding: 14px 32px;
                        background: #3b82f6;
                        color: white;
                        text-decoration: none;
                        border-radius: 8px;
                        font-weight: 600;
                        margin: 0 10px;
                        transition: background 0.3s;
                }

                .btn:hover {
                        background: #2563eb;
                }

                .footer {
                        background: #f9fafb;
                        padding: 25px;
                        text-align: center;
                        color: #6b7280;
                        font-size: 13px;
                        border-top: 1px solid #e5e7eb;
                }

                .timestamp {
                        display: inline-block;
                        background: #dbeafe;
                        color: #1e40af;
                        padding: 4px 12px;
                        border-radius: 12px;
                        font-size: 12px;
                        font-weight: 600;
                        margin-top: 5px;
                }
        </style>
</head>

<body>
        <div class="container">
                <!-- Header -->
                <div class="header">
                        <h1>🔔 New Contact Message</h1>
                        <div class="badge">Requires Your Attention</div>
                </div>

                <!-- Content -->
                <div class="content">
                        <div class="alert">
                                <strong>⚡ Action Required:</strong> You have received a new contact form submission that needs your review.
                        </div>

                        <!-- User Information -->
                        <div class="user-info">
                                <h3>👤 Contact Information</h3>
                                <div class="info-grid">
                                        <div class="info-item">
                                                <span class="info-label">Full Name:</span>
                                                <span class="info-value"><strong>{{ $contactMessage->name }}</strong></span>
                                        </div>

                                        <div class="info-item">
                                                <span class="info-label">Email Address:</span>
                                                <span class="info-value">
                                                        <a href="mailto:{{ $contactMessage->email }}" style="color: #3b82f6; text-decoration: none;">
                                                                {{ $contactMessage->email }}
                                                        </a>
                                                </span>
                                        </div>

                                        @if($contactMessage->phone)
                                        <div class="info-item">
                                                <span class="info-label">Phone Number:</span>
                                                <span class="info-value">
                                                        <a href="tel:{{ $contactMessage->phone }}" style="color: #3b82f6; text-decoration: none;">
                                                                {{ $contactMessage->phone }}
                                                        </a>
                                                </span>
                                        </div>
                                        @endif

                                        <div class="info-item">
                                                <span class="info-label">Subject:</span>
                                                <span class="info-value"><strong>{{ $contactMessage->subject }}</strong></span>
                                        </div>
                                </div>
                        </div>

                        <!-- Message Content -->
                        <div class="message-section">
                                <h4>💬 Message Content</h4>
                                <div class="message-content">
                                        {{ $contactMessage->message }}
                                </div>
                        </div>

                        <!-- Meta Information -->
                        <div class="meta-info">
                                <h4>📊 Submission Details</h4>
                                <div class="meta-item">
                                        <strong>Submitted:</strong>
                                        <span>{{ $contactMessage->created_at->format('F d, Y') }} at {{ $contactMessage->created_at->format('h:i A') }}</span>
                                </div>
                                <div class="meta-item">
                                        <strong>IP Address:</strong>
                                        <span>{{ $contactMessage->ip_address }}</span>
                                </div>
                                <div class="meta-item">
                                        <strong>Status:</strong>
                                        <span class="timestamp">{{ strtoupper($contactMessage->status) }}</span>
                                </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" class="btn">
                                        📧 Reply via Email
                                </a>
                        </div>
                </div>

                <!-- Footer -->
                <div class="footer">
                        <p><strong>Portfolio Admin Panel</strong></p>
                        <p style="margin-top: 8px;">This is an automated notification from your contact form</p>
                        <p style="margin-top: 15px; color: #9ca3af; font-size: 12px;">
                                © {{ date('Y') }} Bhaskar Bisht Portfolio. All rights reserved.
                        </p>
                </div>
        </div>
</body>

</html>