<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Agreement Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 5px solid black;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            margin-bottom: 10px;
        }

        .party-details {
            margin-bottom: 20px;
        }

        .party-details p {
            margin: 5px 0;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body onload="window.print();">
    <div class="container">
        <h1>Project Agreement Contract</h1>
        <hr color="grey" Size="7" />

        <div class="section">
            <h2>Parties</h2>
            <div class="party-details">
                <h3>Party A (Company):</h3>
                <p>Company Name: [Company Name]</p>
                <p>Address: [Company Address]</p>
                <p>Contact Number: [Company Contact Number]</p>
                <p>Email Address: [Company Email Address]</p>
            </div>
            <div class="party-details">
                <h3>Party B (Client):</h3>
                <p>Client Name: <b>[{{$project->client_name}}]<b></p>
                <p>Address: <b>[{{$project->client_email_address}}]<b></p>
                <p>Contact Number: <b>[{{$project->client_contact_number}}]</b></p>
                <p>Email Address: <b>[{{$project->client_email_address}}]</p>b></p>
            </div>
        </div>

        <div class="section">
            <h2>Project Details</h2>
            <p>1.1 Project Name: [Project Name]</p>
            <p>1.2 Project Description: [Project Description]</p>
            <p>1.3 Project Type: [Project Type]</p>
            <p>1.4 Duration: [Duration]</p>
            <p>1.5 Start Time: [Start Time]</p>
            <p>1.6 Team Size: [Team Size]</p>
            <p>1.7 Skill Set Required: [Skill Set]</p>
            <p>1.8 User ID: [User ID]</p>
            <p>1.9 Priority: [Priority]</p>
            <p>1.10 Contract Type: [Contract Type]</p>
            <p>1.11 Status: [Status]</p>
            <p>1.12 Reference: [Reference]</p>
            <p>1.13 Attachment: [Attachment]</p>
            <p>1.14 Git Repository: [Git Repository]</p>
            <p>1.15 Client Name: [Client Name]</p>
            <p>1.16 Level: [Level]</p>
            <p>1.17 Project Management Tool: [Project Management Tool]</p>
            <p>1.18 Ticket ID: [Ticket ID]</p>
            <p>1.19 SDLC Model: [SDLC Model]</p>
            <p>1.20 Total Sprints: [Total Sprints]</p>
            <p>1.21 Project Location: [Project Location]</p>
            <p>1.22 Community: [Community]</p>
            <p>1.23 Client Contact Number: [Client Contact Number]</p>
            <p>1.24 Client Email Address: [Client Email Address]</p>
        </div>

        <div class="section">
            <h2>Scope of Work</h2>
            <p>2.1 Company Responsibilities: The Company agrees to [Company's responsibilities].</p>
            <p>2.2 Client Responsibilities: The Client agrees to [Client's responsibilities].</p>
        </div>

        <div class="section">
            <h2>Payment Terms</h2>
            <p>3.1 Total Project Cost: The total cost of the project is [Total Project Cost].</p>
            <p>3.2 Payment Schedule: Payments shall be made according to the following schedule:</p>
            <p>[Payment Schedule Details]</p>
            <p>3.3 Late Payment: Any payment not received within [Number of Days] days of the due date shall be
                considered late, and a late fee of [Late Fee Percentage]% shall apply.</p>
        </div>

        <!-- Add more sections for Intellectual Property Rights, Confidentiality, Termination, Governing Law, Entire Agreement -->

        <div class="section signature">
            <h2>Signatures and Declaration</h2>
            <p>IN WITNESS WHEREOF, the parties hereto have executed this Contract as of the date first above written.
            </p>
            <p>Party A (Company): [Company Name]</p>
            <p>[Signature of Company Representative]</p>
            <p>[Printed Name of Company Representative]</p>
            <p>[Date]</p>
            <p>Party B (Client): [Client Name]</p>
            <p>[Signature of Client Representative]</p>
            <p>[Printed Name of Client Representative]</p>
            <p>[Date]</p>
        </div>
    </div>
</body>

</html>