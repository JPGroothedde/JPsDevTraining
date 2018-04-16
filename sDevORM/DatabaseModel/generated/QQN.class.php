<?php
	class QQN {
		/**
		 * @return QQNodeAccount
		 */
		static public function Account() {
			return new QQNodeAccount('Account', null, null);
		}
		/**
		 * @return QQNodeApiEntity
		 */
		static public function ApiEntity() {
			return new QQNodeApiEntity('ApiEntity', null, null);
		}
		/**
		 * @return QQNodeApiKey
		 */
		static public function ApiKey() {
			return new QQNodeApiKey('ApiKey', null, null);
		}
		/**
		 * @return QQNodeAuditLogEntry
		 */
		static public function AuditLogEntry() {
			return new QQNodeAuditLogEntry('AuditLogEntry', null, null);
		}
		/**
		 * @return QQNodeBackgroundProcess
		 */
		static public function BackgroundProcess() {
			return new QQNodeBackgroundProcess('BackgroundProcess', null, null);
		}
		/**
		 * @return QQNodeBackgroundProcessUpdate
		 */
		static public function BackgroundProcessUpdate() {
			return new QQNodeBackgroundProcessUpdate('BackgroundProcessUpdate', null, null);
		}
		/**
		 * @return QQNodeEmailMessage
		 */
		static public function EmailMessage() {
			return new QQNodeEmailMessage('EmailMessage', null, null);
		}
		/**
		 * @return QQNodeEmailTemplate
		 */
		static public function EmailTemplate() {
			return new QQNodeEmailTemplate('EmailTemplate', null, null);
		}
		/**
		 * @return QQNodeEmailTemplateContentBlock
		 */
		static public function EmailTemplateContentBlock() {
			return new QQNodeEmailTemplateContentBlock('EmailTemplateContentBlock', null, null);
		}
		/**
		 * @return QQNodeEmailTemplateContentRow
		 */
		static public function EmailTemplateContentRow() {
			return new QQNodeEmailTemplateContentRow('EmailTemplateContentRow', null, null);
		}
		/**
		 * @return QQNodeFileDocument
		 */
		static public function FileDocument() {
			return new QQNodeFileDocument('FileDocument', null, null);
		}
		/**
		 * @return QQNodeLoginToken
		 */
		static public function LoginToken() {
			return new QQNodeLoginToken('LoginToken', null, null);
		}
		/**
		 * @return QQNodePageView
		 */
		static public function PageView() {
			return new QQNodePageView('PageView', null, null);
		}
		/**
		 * @return QQNodePasswordReset
		 */
		static public function PasswordReset() {
			return new QQNodePasswordReset('PasswordReset', null, null);
		}
		/**
		 * @return QQNodePost
		 */
		static public function Post() {
			return new QQNodePost('Post', null, null);
		}
		/**
		 * @return QQNodePostComment
		 */
		static public function PostComment() {
			return new QQNodePostComment('PostComment', null, null);
		}
		/**
		 * @return QQNodePostLike
		 */
		static public function PostLike() {
			return new QQNodePostLike('PostLike', null, null);
		}
		/**
		 * @return QQNodeProfilePicture
		 */
		static public function ProfilePicture() {
			return new QQNodeProfilePicture('ProfilePicture', null, null);
		}
		/**
		 * @return QQNodeRemoteAccess
		 */
		static public function RemoteAccess() {
			return new QQNodeRemoteAccess('RemoteAccess', null, null);
		}
		/**
		 * @return QQNodeSummernoteEntry
		 */
		static public function SummernoteEntry() {
			return new QQNodeSummernoteEntry('SummernoteEntry', null, null);
		}
		/**
		 * @return QQNodeUserRole
		 */
		static public function UserRole() {
			return new QQNodeUserRole('UserRole', null, null);
		}
	}
?>