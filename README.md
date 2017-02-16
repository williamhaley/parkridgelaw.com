# parkridgelaw.com

## Deploy

Commit changes.

```
eb deploy
```

## Initial install

```
eb init -p PHP --region us-east-1
eb create production-env
eb open
```

## DNS

Navigate to `Route53` -> `Hosted zones` -> `Create Hosted Zone`.

Create a `Public hosted zone` for `parkridgelaw.com`.

Create a `Record Set` of type `A`, without specifying a subdomain, pointing at the `Elastic Beanstalk` environment.

Update the DNS provider (Google in this case) to use the custom name servers defined for the `NS` record in `Route53` for this domain.

## Mail

Verify the `SES` email for sender. All you need to do is addd the address under the `Email Addresses` section.

Create a group called `send-email-group` in `IAM`.

Attach a policy to that group. Call the policy `send-email-policy`.

```
{
    "Version": "2012-10-17",
    "Statement": [
    {
       "Effect": "Allow",
       "Action": ["ses:SendEmail", "ses:SendRawEmail"],
       "Resource":"*"
     }
    ]
}
```

Create an `IAM` user named `parkridgelaw.com-send-email-user` with `Programmatic access`. Assign it to the `send-email-group`.

Create an `AWS_ACCESS_KEY_ID` with the access key for the user you just created. Do the same for `AWS_SECRET_ACCESS_KEY`.

Create environment variables also for `MAIL_DAEMON_SENDER` and `MAIL_DAEMON_RECIPIENT`. The former is the address used for the reply-to, the latter is the recipient of the email.

